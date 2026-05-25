<?php
require __DIR__ . '/config.php';
cors();

$userId = requireAuth();
$db = getDB();
ensureAnchorTables();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    handleGet($db, $userId);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['error' => 'Method not allowed'], 405);
}

$input = jsonInput();
$action = $input['action'] ?? '';
$now = (int) round(microtime(true) * 1000);

if ($action === 'invite') {
    handleInvite($db, $userId, $input, $now);
} elseif ($action === 'accept') {
    handleAccept($db, $userId, $input, $now);
} elseif ($action === 'decline') {
    handleDecline($db, $userId, $input);
} elseif ($action === 'cancel') {
    handleCancel($db, $userId, $input);
} elseif ($action === 'remove') {
    handleRemove($db, $userId, $input);
} else {
    jsonResponse(['error' => 'Unknown action'], 400);
}

function handleGet(PDO $db, int $userId): void {
    $tz = new DateTimeZone('America/New_York');
    $today = (new DateTime('now', $tz))->format('Y-m-d');

    $incomingStmt = $db->prepare(
        'SELECT i.id, i.from_user_id, u.username AS from_username, i.created_at
         FROM anchor_invites i
         JOIN users u ON u.id = i.from_user_id
         WHERE i.to_user_id = ? AND i.status = "pending"
         ORDER BY i.created_at DESC'
    );
    $incomingStmt->execute([$userId]);
    $incoming = array_map(function ($r) {
        return [
            'id'            => (int) $r['id'],
            'from_user_id'  => (int) $r['from_user_id'],
            'from_username' => $r['from_username'],
            'created_at'    => (int) $r['created_at'],
        ];
    }, $incomingStmt->fetchAll(PDO::FETCH_ASSOC));

    $outgoingStmt = $db->prepare(
        'SELECT i.id, i.to_user_id, u.username AS to_username, i.created_at
         FROM anchor_invites i
         JOIN users u ON u.id = i.to_user_id
         WHERE i.from_user_id = ? AND i.status = "pending"
         ORDER BY i.created_at DESC'
    );
    $outgoingStmt->execute([$userId]);
    $outgoing = array_map(function ($r) {
        return [
            'id'          => (int) $r['id'],
            'to_user_id'  => (int) $r['to_user_id'],
            'to_username' => $r['to_username'],
            'created_at'  => (int) $r['created_at'],
        ];
    }, $outgoingStmt->fetchAll(PDO::FETCH_ASSOC));

    $pairsStmt = $db->prepare(
        'SELECT i.id AS pair_id,
                CASE WHEN i.from_user_id = ? THEN i.to_user_id ELSE i.from_user_id END AS other_id,
                i.responded_at
         FROM anchor_invites i
         WHERE i.status = "accepted" AND (i.from_user_id = ? OR i.to_user_id = ?)
         ORDER BY i.responded_at ASC, i.id ASC'
    );
    $pairsStmt->execute([$userId, $userId, $userId]);
    $pairRows = $pairsStmt->fetchAll(PDO::FETCH_ASSOC);

    $pairs = [];
    if (count($pairRows) > 0) {
        $otherIds = array_values(array_unique(array_map(function ($r) {
            return (int) $r['other_id'];
        }, $pairRows)));

        $placeholders = implode(',', array_fill(0, count($otherIds), '?'));

        $userStmt = $db->prepare("SELECT id, username FROM users WHERE id IN ($placeholders)");
        $userStmt->execute($otherIds);
        $usernames = [];
        foreach ($userStmt->fetchAll(PDO::FETCH_ASSOC) as $r) {
            $usernames[(int) $r['id']] = $r['username'];
        }

        $prefsMap = [];
        try {
            $prefsStmt = $db->prepare(
                "SELECT user_id, prefs_json FROM user_prefs WHERE user_id IN ($placeholders)"
            );
            $prefsStmt->execute($otherIds);
            foreach ($prefsStmt->fetchAll(PDO::FETCH_ASSOC) as $r) {
                $prefsMap[(int) $r['user_id']] = json_decode($r['prefs_json'], true) ?: new \stdClass();
            }
        } catch (PDOException $e) {
            // user_prefs may not exist yet for new installs
        }

        $dataStmt = $db->prepare(
            "SELECT user_id, items_json, updated_at FROM user_data
             WHERE user_id IN ($placeholders) AND date_str = ?"
        );
        $args = $otherIds;
        $args[] = $today;
        $dataStmt->execute($args);
        $dataMap = [];
        foreach ($dataStmt->fetchAll(PDO::FETCH_ASSOC) as $r) {
            $dataMap[(int) $r['user_id']] = [
                'items'      => json_decode($r['items_json'], true) ?: new \stdClass(),
                'updated_at' => (int) $r['updated_at'],
            ];
        }

        foreach ($pairRows as $r) {
            $other = (int) $r['other_id'];
            $todayEntry = $dataMap[$other] ?? ['items' => new \stdClass(), 'updated_at' => 0];
            $pairs[] = [
                'pair_id'  => (int) $r['pair_id'],
                'user_id'  => $other,
                'username' => $usernames[$other] ?? '',
                'prefs'    => $prefsMap[$other] ?? new \stdClass(),
                'today'    => [
                    'date_str'   => $today,
                    'items'      => $todayEntry['items'],
                    'updated_at' => $todayEntry['updated_at'],
                ],
            ];
        }
    }

    jsonResponse([
        'today'    => $today,
        'pairs'    => $pairs,
        'incoming' => $incoming,
        'outgoing' => $outgoing,
    ]);
}

function handleInvite(PDO $db, int $userId, array $input, int $now): void {
    $email = strtolower(trim($input['to_email'] ?? ''));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['error' => 'Please enter a valid email address.'], 400);
    }

    $stmt = $db->prepare('SELECT id FROM users WHERE LOWER(username) = ?');
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        jsonResponse(['error' => 'No account found with that email. Ask them to sign up first.'], 404);
    }
    $toUserId = (int) $row['id'];
    if ($toUserId === $userId) {
        jsonResponse(['error' => "You can't add yourself as an anchor."], 400);
    }

    $stmt = $db->prepare(
        'SELECT id, from_user_id, to_user_id, status FROM anchor_invites
         WHERE (from_user_id = ? AND to_user_id = ?)
            OR (from_user_id = ? AND to_user_id = ?)'
    );
    $stmt->execute([$userId, $toUserId, $toUserId, $userId]);
    $existing = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($existing as $e) {
        if ($e['status'] === 'accepted') {
            jsonResponse(['error' => 'You are already paired with this user.'], 409);
        }
        // status === 'pending'
        if ((int) $e['to_user_id'] === $userId) {
            // They invited me first — accept their invite instead of creating a new one.
            $upd = $db->prepare(
                'UPDATE anchor_invites SET status = "accepted", responded_at = ? WHERE id = ?'
            );
            $upd->execute([$now, (int) $e['id']]);
            jsonResponse(['ok' => true, 'accepted_existing' => true, 'pair_id' => (int) $e['id']]);
        }
        jsonResponse(['error' => 'Invite already sent.'], 409);
    }

    $ins = $db->prepare(
        'INSERT INTO anchor_invites (from_user_id, to_user_id, status, created_at)
         VALUES (?, ?, "pending", ?)'
    );
    $ins->execute([$userId, $toUserId, $now]);
    jsonResponse(['ok' => true, 'invite_id' => (int) $db->lastInsertId()]);
}

function handleAccept(PDO $db, int $userId, array $input, int $now): void {
    $id = (int) ($input['invite_id'] ?? 0);
    $stmt = $db->prepare(
        'SELECT id FROM anchor_invites WHERE id = ? AND to_user_id = ? AND status = "pending"'
    );
    $stmt->execute([$id, $userId]);
    if (!$stmt->fetch()) {
        jsonResponse(['error' => 'Invite not found.'], 404);
    }
    $upd = $db->prepare(
        'UPDATE anchor_invites SET status = "accepted", responded_at = ? WHERE id = ?'
    );
    $upd->execute([$now, $id]);
    jsonResponse(['ok' => true]);
}

function handleDecline(PDO $db, int $userId, array $input): void {
    $id = (int) ($input['invite_id'] ?? 0);
    $stmt = $db->prepare(
        'SELECT id FROM anchor_invites WHERE id = ? AND to_user_id = ? AND status = "pending"'
    );
    $stmt->execute([$id, $userId]);
    if (!$stmt->fetch()) {
        jsonResponse(['error' => 'Invite not found.'], 404);
    }
    $del = $db->prepare('DELETE FROM anchor_invites WHERE id = ?');
    $del->execute([$id]);
    jsonResponse(['ok' => true]);
}

function handleCancel(PDO $db, int $userId, array $input): void {
    $id = (int) ($input['invite_id'] ?? 0);
    $stmt = $db->prepare(
        'SELECT id FROM anchor_invites WHERE id = ? AND from_user_id = ? AND status = "pending"'
    );
    $stmt->execute([$id, $userId]);
    if (!$stmt->fetch()) {
        jsonResponse(['error' => 'Invite not found.'], 404);
    }
    $del = $db->prepare('DELETE FROM anchor_invites WHERE id = ?');
    $del->execute([$id]);
    jsonResponse(['ok' => true]);
}

function handleRemove(PDO $db, int $userId, array $input): void {
    $id = (int) ($input['pair_id'] ?? 0);
    $stmt = $db->prepare(
        'SELECT id FROM anchor_invites
         WHERE id = ? AND (from_user_id = ? OR to_user_id = ?) AND status = "accepted"'
    );
    $stmt->execute([$id, $userId, $userId]);
    if (!$stmt->fetch()) {
        jsonResponse(['error' => 'Pair not found.'], 404);
    }
    $del = $db->prepare('DELETE FROM anchor_invites WHERE id = ?');
    $del->execute([$id]);
    jsonResponse(['ok' => true]);
}
