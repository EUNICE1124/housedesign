<?php
require 'db_connect.php';
// Fetch all materials from the database
$result = $conn->query("SELECT * FROM materials ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials Store | HouseDesign</title>
    <link rel="stylesheet" href="style.css">
</head>
<body oncontextmenu="return false;">
    <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en', 
    includedLanguages: 'en,fr,es,de,it,pt,zh-CN,ar,ru,ja,hi,bn,ko,tr,vi,pl,nl,th,sw,yo', 
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <header>
        <div class="logo"><img src="images/logo.png" alt="HouseDesign Logo"></div>
        <nav>
            <a href="index.html">Home</a>
            <a href="services.html">Services</a>
            <a href="store.php" class="active">Materials</a>
            <a href="about.php">About Us</a>
            <a href="portfolio.html">Portfolio</a>
        </nav>
    </header>

    <section class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h1 style="color: var(--navy);">CONSTRUCTION MATERIALS</h1>
            <div id="cart-counter" style="background: var(--safety-red); color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold;">
                Official Engineering Stock
            </div>
        </div>

        <div class="grid-3">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <div style="height:180px; background:#eee; display:flex; align-items:center; justify-content:center; border-radius:4px;">
                            <span style="font-size:3rem;">🏗️</span>
                        </div>
                        <div style="padding-top: 15px;">
                            <h3><?php echo htmlspecialchars($row['material_name']); ?></h3>
                            <p>Quality assured for structural integrity.</p>
                            <p><strong>Price:</strong> <?php echo number_format($row['price']); ?> XAF</p>
                            <button class="btn-red" onclick="alert('Inquiry sent for <?php echo $row['material_name']; ?>')" style="width: 100%; margin-top: 10px;">Send Inquiry</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No materials currently listed in the digital store.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer style="background: var(--navy); color: white; padding: 40px 10%; margin-top: 50px;">
        <p style="text-align: center;">© 2026 HouseDesign Engineering - Yaoundé</p>
    </footer>
</body>
</html>