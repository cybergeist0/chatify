<?php
// fetch_messages.php
session_start();
require 'database.php';

if (!isset($_SESSION['user'])) {
    exit();
}

$messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();

foreach ($messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message['username']) . ":</strong> " . htmlspecialchars($message['message']) . "</p>";
}
?>
