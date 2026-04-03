<?php 
require 'db_connect.php'; 

// Fetch the 6 most recent videos uploaded via the admin panel
$video_query = $conn->query("SELECT * FROM about_videos ORDER BY uploaded_at DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | HouseDesign</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
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
            <a href="store.php">Materials</a>
            <a href="about.php" class="active">About Us</a>
        </nav>
    </header>

    <section class="hero" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/hero-bg.jpg'); height: 300px; display: flex; align-items: center; justify-content: center; color: white;">
        <h1>Our Engineering Journey</h1>
    </section>

    <section style="padding: 50px 10%;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
            <div>
                <h2 style="color: var(--navy); border-left: 5px solid var(--safety-red); padding-left: 15px;">Expertise in Every Build</h2>
                <p style="margin-top: 20px; line-height: 1.6;">
                    HouseDesign is a leading structural engineering firm dedicated to transforming architectural visions into safe, sustainable, and stunning realities. From initial blueprint analysis to final site inspections, our team ensures every project meets international safety standards.
                </p>
                <p style="margin-top: 15px; line-height: 1.6;">
                    Our digital store and project tracking system allow clients to monitor material quality and construction progress in real-time.
                </p>
            </div>
            <div>
                <img src="images/engineer-work.jpg" alt="Engineer at work" style="width: 100%; border-radius: 8px; shadow: 0 4px 8px rgba(0,0,0,0.1);">
            </div>
        </div>
    </section>

    <section style="background: #f4f4f4; padding: 60px 10%;">
        <h2 style="text-align: center; color: var(--navy); margin-bottom: 40px;">Real-Time Site Inspections & Work</h2>
        
        <div class="video-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
            <?php if ($video_query && $video_query->num_rows > 0): ?>
                <?php while($row = $video_query->fetch_assoc()): ?>
                    <div class="card" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <div class="video-container">
                            <video width="100%" controls style="display: block; background: #000;">
                                <source src="<?php echo htmlspecialchars($row['video_path']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div style="padding: 15px; text-align: center;">
                            <p style="font-weight: bold; color: var(--navy);"><?php echo htmlspecialchars($row['video_title']); ?></p>
                            <p style="font-size: 0.8rem; color: #777;">
                                Recorded: <?php echo date('F d, Y', strtotime($row['uploaded_at'])); ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; background: #eee; border-radius: 8px;">
                    <p>No project videos have been uploaded to the database yet.</p>
                    <p><small>Admin: Use the Upload tool in the Dashboard to add site-work videos.</small></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer style="background: var(--navy); color: white; padding: 40px 10%; border-top: 5px solid var(--safety-red); margin-top: 50px;">
        <div style="text-align: center;">
            <p>© 2026 HouseDesign Engineering - Quality & Safety First.</p>
        </div>
    </footer>
</body>
</html>