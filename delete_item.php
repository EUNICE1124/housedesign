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
<?php
session_start();
if (!isset($_SESSION['authenticated'])) exit;

$servername = "localhost";
$username = "root";
$password = "25J2007ayaounde";
$dbname = "housedesign_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Delete Material
if (isset($_POST['delete_material'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM materials WHERE id = $id");
    header("Location: admin-dashboard.php");
}

// Delete Blueprint File
if (isset($_POST['delete_file'])) {
    $filename = $_POST['filename'];
    $path = "uploads/" . $filename;
    if (file_exists($path)) {
        unlink($path); // This deletes the physical file
    }
    header("Location: admin-dashboard.php");
}
?>