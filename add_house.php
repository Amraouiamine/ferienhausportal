<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ferienhaus hinzufügen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .form-box {
            background-color: white;
            padding: 2rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 600px;
        }

        .form-box h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.4rem;
            color: #2c3e50;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }

        .submit-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 0.7rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #219653;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h1>Ferienhaus hinzufügen</h1>
        <form action="add_house_process.php" method="POST">
            <div class="form-group">
                <label for="name">Name des Hauses</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="location">Ort</label>
                <input type="text" name="location" id="location" required>
            </div>
            <div class="form-group">
                <label for="availability">Verfügbarkeit</label>
                <input type="text" name="availability" id="availability" required>
            </div>
            <div class="form-group">
                <label for="price">Preis pro Nacht (€)</label>
                <input type="number" step="0.01" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label for="images">Bild-URLs (kommagetrennt)</label>
                <input type="text" name="images" id="images">
            </div>
            <div class="form-group">
                <label>Ausstattung:</label>
                <?php
                require 'db.php';
                $stmt = $pdo->query("SELECT * FROM amenities");
                while ($row = $stmt->fetch()) {
                    echo '<label><input type="checkbox" name="amenities[]" value="' . $row['id'] . '"> ' . htmlspecialchars($row['name']) . '</label><br>';
                }
                ?>
            </div>
            <button type="submit" class="submit-btn">Hinzufügen</button>
        </form>
    </div>
</body>
</html>
