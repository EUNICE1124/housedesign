
<?php
session_start();
require 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Engineer Admin | HouseDesign</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: var(--navy); color: white; }
        .btn-delete { color: var(--safety-red); text-decoration: none; font-weight: bold; }
    </style>
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
            <span style="color: white; margin-right: 20px;">Admin: <strong>Tchouelaeric</strong></span>
            <a href="index.html">Logout</a>
        </nav>
    </header>

    <main class="container">
        <h1>Engineering Management Portal</h1>

        <section style="background: white; padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: var(--shadow);">
            <h3>Add New Material to Store</h3>
            <form action="add_material.php" method="POST" style="display: flex; gap: 10px; margin-top: 15px;">
                <input type="text" name="materialName" placeholder="Material Name" required style="padding: 10px; flex: 2;">
                <input type="number" name="materialPrice" placeholder="Price (XAF)" required style="padding: 10px; flex: 1;">
                <button type="submit" class="btn-red">Save to Database</button>
            </form>
        </section>

        <section>
            <h3>Incoming Client Inquiries</h3>
            <table>
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Requested Service</th>
                        <th>Date Received</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $inquiries = $conn->query("SELECT * FROM inquiries ORDER BY inquiry_date DESC");
                    if ($inquiries->num_rows > 0) {
                        while($row = $inquiries->fetch_assoc()) {
                            echo "<tr>
                                    <td>".htmlspecialchars($row['client_name'])."</td>
                                    <td>".htmlspecialchars($row['service_type'])."</td>
                                    <td>".$row['inquiry_date']."</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No inquiries found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section style="margin-top: 40px;">
            <h3>Active Store Inventory</h3>
            <table>
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Price (XAF)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $materials = $conn->query("SELECT * FROM materials ORDER BY created_at DESC");
                    while($row = $materials->fetch_assoc()) {
                        echo "<tr>
                                <td>".htmlspecialchars($row['material_name'])."</td>
                                <td>".number_format($row['price'])."</td>
                                <td><a href='delete_material.php?id=".$row['id']."' class='btn-delete' onclick='return confirm(\"Remove this item?\")'>[Delete]</a></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        // Check if user is logged in via the session variable set in login.html
        if (sessionStorage.getItem('isAdmin') !== 'true') {
            window.location.href = "login.html";
        }
    </script>
</body>
</html>