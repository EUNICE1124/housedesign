<?php
$conn = new mysqli("localhost", "root", "25J2007ayaounde", "housedesign_db");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | HouseDesign</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><img src="images/logo.png" alt="HouseDesign"></div>
        <nav>
            <a href="index.html">Home</a>
            <a href="store.php">Materials</a>
            <a href="services.html">Services</a>
            <a href="portfolio.php">Portfolio</a>
        </nav>
    </header>

    <main class="container">
        <h1>Our Journey & Expertise</h1>
        <div class="video-gallery" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            <?php
            $result = $conn->query("SELECT * FROM company_videos ORDER BY upload_date DESC");
            while($row = $result->fetch_assoc()): ?>
                <div class="video-card" style="background: white; padding: 15px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <h3 style="color: var(--navy);"><?php echo htmlspecialchars($row['video_title']); ?></h3>
                    <video width="100%" controls style="border-radius: 4px;">
                        <source src="<?php echo $row['file_path']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>