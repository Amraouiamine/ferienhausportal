<?php session_start(); ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Benutzer hinzufügen</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 500px;
            margin: 3rem auto;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.7rem;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        .submit-btn:hover {
            background-color: #2980b9;
        }
        .message {
            text-align: center;
            margin-top: 1rem;
            color: red;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Benutzer hinzufügen</h2>
    <form action="add_user_process.php" method="post">
        <div class="form-group">
            <label for="username">Benutzername</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Passwort</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="submit-btn">Hinzufügen</button>

        <?php if (!empty($_SESSION['user_message'])): ?>
            <div class="message"><?php echo $_SESSION['user_message']; unset($_SESSION['user_message']); ?></div>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
