<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #2980b9, #6dd5fa, #ffffff);
        }

        .login-box {
            background-color: white;
            padding: 2rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-box h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        .error-message {
            color: red;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Login</h1>

        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="error-message"><?= $_SESSION['login_error'] ?></div>
            <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="submit-btn">Einloggen</button>
        </form>
    </div>
</body>
</html>
