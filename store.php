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
<main class="container">
    <h1>Construction Materials</h1>
    <table style="width:100%; border-collapse: collapse;">
        <tr style="background:#001f3f; color:white;">
            <th style="padding:15px;">Material</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php
        // Database Connection
        $servername = "localhost";
        $username = "root";
        $password = "25J2007ayaounde"; // Your DB password
        $dbname = "housedesign_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            echo "<tr><td colspan='3'>Connection failed: " . $conn->connect_error . "</td></tr>";
        } else {
            // Fetch materials from the database
            $sql = "SELECT material_name, price FROM materials ORDER BY material_name ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td style='padding:15px; border-bottom: 1px solid #ddd;'>" . htmlspecialchars($row["material_name"]) . "</td>";
                    echo "<td style='border-bottom: 1px solid #ddd;'>$" . number_format($row["price"], 2) . "</td>";
                    echo "<td style='border-bottom: 1px solid #ddd;'><button class='btn-red' onclick='addToQuote(" . $row["price"] . ")'>Add to Quote</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' style='padding:20px; text-align:center;'>No materials available in the store yet.</td></tr>";
            }
            $conn->close();
        }
        ?>
    </table>
</main>