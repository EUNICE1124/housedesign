<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolio | Secure Access</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
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
        <div class="logo"><img src="images/logo.png" alt="HouseDesign"></div>
        <nav>
            <a href="index.html">Home</a>
            <a href="services.html">Services</a>
            <a href="store.html">Materials</a>
            <a href="portfolio.php">Portfolio</a>
        </nav>
    </header>

    <section class="container" style="padding: 60px 10%;">
        <div id="vault-lock" style="text-align: center; padding: 50px; background: white; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="font-size: 4rem; color: var(--navy); margin-bottom: 20px;">🔒</div>
            <h2>Secure Document Vault</h2>
            <p>Access is restricted to authorized partners and clients.</p>
            <button onclick="accessVault()" class="btn-red" style="margin-top: 20px; padding: 15px 40px;">Enter Access Token</button>
        </div>

        <div id="vault-content" style="display: none;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h2>Project Portfolio & Blueprints</h2>
                <span class="btn-outline" style="color: var(--navy); border-color: var(--navy); cursor: pointer;" onclick="location.reload()">Refresh Gallery</span>
            </div>

            <div class="grid-3" id="client-gallery">
                <?php
                $dir = "uploads/";
                
                // Ensure the folder exists
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }

                $files = array_diff(scandir($dir), array('.', '..'));

                if (count($files) > 0) {
                    foreach ($files as $file) {
                        $filePath = $dir . $file;
                        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        
                        echo '<div class="card" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.3s;">';
                        
                        // Preview Logic
                        echo '<div style="height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; overflow: hidden;">';
                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo '<img src="'.$filePath.'" style="width: 100%; height: 100%; object-fit: cover;">';
                        } else {
                            // Icon for PDF or other documents
                            echo '<div style="text-align:center;"><span style="font-size: 4rem;">📄</span><br><small>'.strtoupper($extension).'</small></div>';
                        }
                        echo '</div>';

                        // File Details
                        echo '<div style="padding: 15px;">';
                        echo '<h4 style="margin: 0; color: var(--navy); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">' . $file . '</h4>';
                        echo '<p style="font-size: 0.8rem; color: #666;">Date: ' . date("F d Y", filemtime($filePath)) . '</p>';
                        echo '<a href="'.$filePath.'" target="_blank" class="btn-red" style="display: block; text-align: center; margin-top: 15px; text-decoration: none; font-size: 0.9rem;">Download / View</a>';
                        echo '</div>';
                        
                        echo '</div>';
                    }
                } else {
                    echo '<div style="grid-column: span 3; text-align: center; padding: 40px;">';
                    echo '<p>No documents found in the vault.</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <footer style="background: var(--navy); color: white; padding: 40px 10%; margin-top: 50px; border-top: 5px solid var(--safety-red);">
        <div style="text-align: center; opacity: 0.5; font-size: 0.8rem;">
            © 2026 HouseDesign | <a href="admin-dashboard.html" style="color:white; text-decoration:none;">Staff</a>
        </div>
    </footer>
</body>
</html>