<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $_SESSION['user_message'] = "Bitte Benutzername und Passwort eingeben.";
        header("Location: add_user.php");
        exit;
    }

    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['user_message'] = "Benutzername existiert bereits.";
        $check->close();
        header("Location: add_user.php");
        exit;
    }
    $check->close();

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $insert->bind_param("ss", $username, $hashed);

    if ($insert->execute()) {
        $_SESSION['user_message'] = "Benutzer erfolgreich hinzugefügt.";
    } else {
        $_SESSION['user_message'] = "Fehler beim Speichern.";
    }
    $insert->close();
    header("Location: add_user.php");
}
?>
