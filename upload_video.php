<?php
// 1. Connect to your database
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $title = $conn->real_escape_string($_POST['videoTitle']);
    
    // 2. Define where the video will be saved
    $target_dir = "uploads/";
    $file_name = basename($_FILES["videoFile"]["name"]);
    $target_file = $target_dir . $file_name;
    $video_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 3. Simple security check: Only allow video formats
    $allowed_types = array("mp4", "avi", "mov", "mpeg");
    
    if (in_array($video_type, $allowed_types)) {
        // 4. Move the file from temporary memory to your 'uploads' folder
        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $target_file)) {
            
            // 5. Save the title and the path in the database
            $sql = "INSERT INTO about_videos (video_title, video_path) VALUES ('$title', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                // Return to admin dashboard with success message
                header("Location: admin.php?upload=success");
            } else {
                echo "Database Error: " . $conn->error;
            }
        } else {
            echo "Error: Could not move the file to the uploads folder. Check folder permissions.";
        }
    } else {
        echo "Error: Only MP4, AVI, MOV, and MPEG files are allowed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Engineering Video</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="padding: 50px; max-width: 500px; margin: auto;">
        <h2>Upload About Us Video</h2>
        <form action="upload_video.php" method="POST" enctype="multipart/form-data">
            <label>Video Title (e.g., Site Inspection):</label><br>
            <input type="text" name="videoTitle" required style="width:100%; padding:10px; margin:10px 0;"><br>
            
            <label>Select Video File:</label><br>
            <input type="file" name="videoFile" accept="video/*" required style="margin:10px 0;"><br>
            
            <button type="submit" class="btn-red" style="padding:10px 20px; cursor:pointer;">Upload to Site</button>
            <a href="admin.php" style="margin-left:10px;">Back to Admin</a>
        </form>
    </div>
</body>
</html>