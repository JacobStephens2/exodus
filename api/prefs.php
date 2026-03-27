<?php
require __DIR__ . '/config.php';
cors();

$userId = requireAuth();
$db = getDB();
ensureUserPrefsTable();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $db->prepare('SELECT prefs_json, updated_at FROM user_prefs WHERE user_id = ?');
    $stmt->execute([$userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    jsonResponse([
        'prefs' => $row ? (json_decode($row['prefs_json'], true) ?: new stdClass()) : new stdClass(),
        'updated_at' => $row ? (int) $row['updated_at'] : 0,
    ]);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = jsonInput();
    $prefs = $input['prefs'] ?? new stdClass();
    $updatedAt = (int) ($input['updated_at'] ?? 0);

    $prefsJson = json_encode($prefs);
    if ($prefsJson === false) {
        jsonResponse(['error' => 'Invalid preferences payload.'], 400);
    }

    $stmt = $db->prepare(
        'INSERT INTO user_prefs (user_id, prefs_json, updated_at)
         VALUES (?, ?, ?)
         ON DUPLICATE KEY UPDATE
           prefs_json  = IF(VALUES(updated_at) > updated_at, VALUES(prefs_json), prefs_json),
           updated_at  = IF(VALUES(updated_at) > updated_at, VALUES(updated_at), updated_at)'
    );
    $stmt->execute([$userId, $prefsJson, $updatedAt]);

    jsonResponse(['ok' => true]);

} else {
    jsonResponse(['error' => 'Method not allowed'], 405);
}
