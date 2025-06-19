<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

if (isset($_GET['id'])) {
    $house_id = (int) $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM house_images WHERE house_id = ?");
    $stmt->execute([$house_id]);

    $stmt = $pdo->prepare("DELETE FROM house_amenities WHERE house_id = ?");
    $stmt->execute([$house_id]);

    $stmt = $pdo->prepare("DELETE FROM houses WHERE id = ?");
    $stmt->execute([$house_id]);
}

header("Location: index.php");
exit;
?>
