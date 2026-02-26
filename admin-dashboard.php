<?php
session_start();
// Security Guard: Redirect to login if not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
}

// Database Connection Details
$servername = "localhost";
$username = "root";
$password = "25J2007ayaounde";
$dbname = "housedesign_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Engineer Admin | HouseDesign</title>
    <link rel="stylesheet" href="style.css">
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
        <div class="logo"><img src="images/logo.png" alt="HouseDesign"></div>
        <nav><a href="index.html">Back to Site</a></nav>
    </header>

    <main class="container" style="padding: 50px 10%;">
        <h1>Engineer Upload Portal</h1>
        
        <section style="background: white; padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h3>Upload New Blueprint</h3>
            <div style="border: 3px dashed var(--navy); padding: 20px; text-align: center;">
                <form action="upload_blueprint.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="blueprint" required>
                    <button type="submit" class="btn-red" style="margin-left: 10px; cursor: pointer;">Upload to Vault</button>
                </form>
            </div>
        </section>

        <section style="background: white; padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h3>Add New Material to Store</h3>
            <div style="display: flex; gap: 10px; margin-top: 15px;">
                <input type="text" id="matName" placeholder="Material Name" style="padding: 10px; flex: 2;">
                <input type="number" id="matPrice" placeholder="Price ($)" style="padding: 10px; flex: 1;">
                <button onclick="addMaterial()" class="btn-red" style="cursor: pointer;">Add to Store</button>
            </div>

            <h4 style="margin-top: 30px;">Current Materials in Database</h4>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr style="background: #f4f4f4; text-align: left;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Material</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Price</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM materials ORDER BY material_name ASC");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . htmlspecialchars($row['material_name']) . "</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>$" . number_format($row['price'], 2) . "</td>";
                        echo "<td style='padding: 10px; border: 1px solid #ddd;'>
                                <form method='POST' action='delete_item.php' onsubmit='return confirm(\"Delete this material?\");'>
                                    <input type='hidden' name='id' value='".$row['id']."'>
                                    <button type='submit' name='delete_material' style='color:red; background:none; border:none; cursor:pointer;'>[Delete]</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='padding: 10px; text-align: center;'>No materials found.</td></tr>";
                }
                ?>
            </table>
        </section>

        <section style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h3>Stored Portfolio Blueprints</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-top: 15px;">
                <?php
                $dir = "uploads/";
                if (is_dir($dir)) {
                    $files = array_diff(scandir($dir), array('.', '..', 'upload_blueprint.php', 'upload.php'));
                    foreach ($files as $file) {
                        echo "<div style='border: 1px solid #ddd; padding: 15px; text-align: center; border-radius: 5px;'>";
                        echo "<span style='font-size: 2rem;'>📄</span>";
                        echo "<p style='font-size: 0.8rem; margin: 10px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>$file</p>";
                        echo "<form method='POST' action='delete_item.php' onsubmit='return confirm(\"Delete this file?\");'>";
                        echo "<input type='hidden' name='filename' value='".htmlspecialchars($file)."'>";
                        echo "<button type='submit' name='delete_file' style='color:red; background:none; border: 1px solid red; padding: 5px 10px; cursor: pointer; font-size: 0.7rem; border-radius: 3px;'>Remove File</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </section>

        <h3>Status Updates</h3>
        <?php if(isset($_GET['status'])): ?>
            <p style="color: green; font-weight: bold;">Action successful!</p>
        <?php endif; ?>
    </main>

    <script>
    async function addMaterial() {
        const name = document.getElementById('matName').value;
        const price = document.getElementById('matPrice').value;
        if(!name || !price) { alert("Please enter both name and price."); return; }

        const formData = new FormData();
        formData.append('materialName', name);
        formData.append('materialPrice', price);

        try {
            const response = await fetch('add_material.php', { method: 'POST', body: formData });
            const result = await response.json();
            alert(result.message);
            if(result.status === "success") location.reload();
        } catch (e) {
            alert("Error adding material. Check console.");
        }
    }
    </script>
</body>
</html>