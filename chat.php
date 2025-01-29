<?php
// chat.php
session_start();
require 'database.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
    $message = $_POST['message'];
    $username = $_SESSION['user'];

    if ($username == 'admin' && $message == '/clear') {
        // Admin command to clear the chat
        $pdo->exec("DELETE FROM messages");
    } else {
        $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
        $stmt->execute(['username' => $username, 'message' => $message]);
    }

    // Redirect to avoid resubmission on refresh
    header("Location: chat.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chatify - Chat</title>
    <link rel="stylesheet" type="text/css" href="chat-style.css">
    <script>
        function fetchMessages() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_messages.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.querySelector('.messages').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }

        function sendMessage(e) {
            e.preventDefault();
            var message = document.querySelector('input[name="message"]').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'chat.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status == 200) {
                    document.querySelector('input[name="message"]').value = '';
                    fetchMessages();
                }
            };
            xhr.send('message=' + encodeURIComponent(message));
        }

        setInterval(fetchMessages, 3000); // Fetch messages every 3 seconds
        </script>
</head>
<body onload="fetchMessages()">
    <div class="container">
        <h1>Chatify</h1>
        <div class="messages"></div>
        <form onsubmit="sendMessage(event)">
            <div class="input-container">
                <input type="text" name="message" placeholder="Type your message..." required>
                <button type="submit">Send</button>
            </div>
        </form>
        <form class="logout-form" action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
