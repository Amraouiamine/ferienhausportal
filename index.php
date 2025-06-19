<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ferienhäuser - Urlaub im Grünen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <div class="logo">Ferienhäuser</div>
    <div class="search-container">
        <input type="text" placeholder="Zielort, Hausname oder Region...">
        <button class="search-btn">Suchen</button>
    </div>
    <div>
        <?php if (isset($_SESSION['user'])): ?>
            <a class="login-btn" href="add_house.php">Haus hinzufügen</a>
            <a class="login-btn" href="logout.php">Logout</a>
        <?php else: ?>
            <a class="login-btn" href="login.php">Login</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <h1>Unsere Ferienhäuser</h1>

    <div class="houses">
        <?php
        $houses = $pdo->query("SELECT * FROM houses")->fetchAll();

        foreach ($houses as $house):
            $stmt = $pdo->prepare("SELECT image_url FROM house_images WHERE house_id = ?");
            $stmt->execute([$house['id']]);
            $images = $stmt->fetchAll();

            $stmt = $pdo->prepare("
                SELECT a.name FROM amenities a
                JOIN house_amenities ha ON ha.amenity_id = a.id
                WHERE ha.house_id = ?
            ");
            $stmt->execute([$house['id']]);
            $amenities = $stmt->fetchAll();
        ?>
        <div class="house-card">
            <div class="house-images">
                <?php foreach ($images as $img): ?>
                    <img src="<?= htmlspecialchars($img['image_url']) ?>" alt="Hausbild">
                <?php endforeach; ?>
            </div>
            <div class="house-info">
                <h2><?= htmlspecialchars($house['name']) ?></h2>
                <div class="location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <span><?= htmlspecialchars($house['location']) ?></span>
                </div>
                <span class="availability">Verfügbar: <?= htmlspecialchars($house['availability']) ?></span>
                <span class="price">ab <?= number_format($house['price'], 2, ',', '.') ?> €/Nacht</span>

                <div class="amenities">
                    <?php foreach ($amenities as $a): ?>
                        <div class="amenity">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"><circle cx="12" cy="12" r="6"/></svg>
                            <?= htmlspecialchars($a['name']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="book-btn">Jetzt buchen</button>
<?php if (isset($_SESSION['user'])): ?>
    <form action="delete_house.php" method="GET" style="margin-top: 1rem;">
        <input type="hidden" name="id" value="<?php echo $house['id']; ?>">
        <button type="submit" class="book-btn" style="background-color: #e74c3c;">Löschen</button>
    </form>
<?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
