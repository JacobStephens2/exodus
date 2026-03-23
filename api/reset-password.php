<?php
require __DIR__ . '/config.php';
cors();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['error' => 'Method not allowed'], 405);
}

$input = jsonInput();
$token = $input['token'] ?? '';
$password = $input['password'] ?? '';

if (!preg_match('/^[a-f0-9]{64}$/', $token)) {
    jsonResponse(['error' => 'Invalid or expired reset link.'], 400);
}

if (strlen($password) < 6) {
    jsonResponse(['error' => 'Password must be at least 6 characters.'], 400);
}

$db = getDB();

// Look up valid, non-expired reset token
$stmt = $db->prepare(
    'SELECT user_id FROM password_resets WHERE token = ? AND expires_at > NOW()'
);
$stmt->execute([$token]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    jsonResponse(['error' => 'Invalid or expired reset link.'], 400);
}

$userId = (int) $row['user_id'];

// Update the password
$hash = password_hash($password, PASSWORD_DEFAULT);
$db->prepare('UPDATE users SET password_hash = ? WHERE id = ?')->execute([$hash, $userId]);

// Delete all reset tokens for this user
$db->prepare('DELETE FROM password_resets WHERE user_id = ?')->execute([$userId]);

// Invalidate all existing login tokens so they must re-authenticate
$db->prepare('DELETE FROM tokens WHERE user_id = ?')->execute([$userId]);

jsonResponse(['ok' => true]);
