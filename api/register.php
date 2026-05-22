<?php
require __DIR__ . '/config.php';
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

cors();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['error' => 'Method not allowed'], 405);
}

$input = jsonInput();
$username = trim($input['username'] ?? '');
$password = $input['password'] ?? '';

if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['error' => 'Please enter a valid email address.'], 400);
}
if (strlen($password) < 6) {
    jsonResponse(['error' => 'Password must be at least 6 characters.'], 400);
}

$db = getDB();
ensureUserPrefsTable();

$exists = $db->prepare('SELECT 1 FROM users WHERE username = ?');
$exists->execute([$username]);
if ($exists->fetch()) {
    jsonResponse(['error' => 'An account with this email already exists.'], 409);
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$db->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)')->execute([$username, $hash]);
$userId = (int) $db->lastInsertId();

$token = bin2hex(random_bytes(32));
$db->prepare('INSERT INTO tokens (token, user_id) VALUES (?, ?)')->execute([$token, $userId]);

$now = round(microtime(true) * 1000);

$checklist = $input['checklist'] ?? [];
$notes = $input['notes'] ?? [];
$prefs = $input['prefs'] ?? new stdClass();
$prefsUpdatedAt = (int) ($input['prefs_updated_at'] ?? 0);
$allDates = array_unique(array_merge(array_keys($checklist), array_keys($notes)));

if (count($allDates) > 0) {
    $stmt = $db->prepare(
        'INSERT INTO user_data (user_id, date_str, items_json, note, updated_at) VALUES (?, ?, ?, ?, ?)'
    );
    foreach ($allDates as $dateStr) {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateStr)) continue;
        $items = isset($checklist[$dateStr]) ? json_encode($checklist[$dateStr]) : '{}';
        $note = $notes[$dateStr] ?? '';
        $stmt->execute([$userId, $dateStr, $items, $note, $now]);
    }
}

$prefsJson = json_encode($prefs);
if ($prefsJson !== false) {
    $stmt = $db->prepare(
        'INSERT INTO user_prefs (user_id, prefs_json, updated_at) VALUES (?, ?, ?)'
    );
    $stmt->execute([$userId, $prefsJson, $prefsUpdatedAt]);
}

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
    $mail->addAddress('jacob@stephens.page');
    $mail->Subject = 'Exodus 40 Lite — New Account Created';
    $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? 'unknown', 0, 1024);
    $mail->Body = "A new account was created on Exodus 40 Lite.\n\n"
        . "Email: " . $username . "\n"
        . "Date: " . gmdate('c') . "\n"
        . "Device: " . $ua;
    $mail->send();
} catch (\Throwable $e) {
    error_log('Failed to send admin signup notification: ' . $e->getMessage());
}

jsonResponse(['token' => $token, 'username' => $username]);
