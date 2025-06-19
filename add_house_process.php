<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $availability = $_POST['availability'];
    $price = $_POST['price'];
    $images = explode(",", $_POST['images']);
    $amenities = $_POST['amenities'] ?? [];

    $stmt = $pdo->prepare("INSERT INTO houses (name, location, availability, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $location, $availability, $price]);
    $house_id = $pdo->lastInsertId();

    foreach ($images as $img) {
        $trimmed = trim($img);
        if (!empty($trimmed)) {
            $stmt = $pdo->prepare("INSERT INTO house_images (house_id, image_url) VALUES (?, ?)");
            $stmt->execute([$house_id, $trimmed]);
        }
    }

    foreach ($amenities as $amenity_id) {
        $stmt = $pdo->prepare("INSERT INTO house_amenities (house_id, amenity_id) VALUES (?, ?)");
        $stmt->execute([$house_id, $amenity_id]);
    }

    header("Location: index.php");
    exit;
}
?>
