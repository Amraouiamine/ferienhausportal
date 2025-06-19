<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $password == $user['password']) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Login fehlgeschlagen: Ungültige Zugangsdaten.";
        header("Location: login.php");
        exit;
    }
}
?>
