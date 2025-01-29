<?php
// logout.php
session_start();
session_destroy();
header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chatify - Logout</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Chatify</h1>
        <p>You have been logged out.</p>
        <p><a href="index.php">Log In</a> again.</p>
    </div>
</body>
</html>

