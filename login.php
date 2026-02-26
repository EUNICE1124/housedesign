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

// 1. Define your secure credentials
$admin_user = "Tchouela eric"; 
$admin_pass = "Design2026!"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === $admin_user && $pass === $admin_pass) {
        $_SESSION['authenticated'] = true;
        header("Location: admin-dashboard.php"); // Redirect to the dashboard
        exit;
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Login | HouseDesign</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f4f4;">
    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px;">
        <h2 style="text-align: center; color: var(--navy);">Staff Login</h2>
        <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required style="width:100%; margin: 10px 0; padding: 10px;">
            <input type="password" name="password" placeholder="Password" required style="width:100%; margin: 10px 0; padding: 10px;">
            <button type="submit" class="btn-red" style="width: 100%; cursor: pointer;">Enter Portal</button>
        </form>
    </div>
</body>
</html>