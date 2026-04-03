<?php
session_start();
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location:login.php");
    exit();
}
require 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Engineer Admin | HouseDesign</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-main { padding: 40px 5%; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: var(--shadow); margin-bottom: 30px; }
        .upload-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: var(--navy); color: white; }
        .status-pending { color: orange; font-weight: bold; }
        .status-done { color: green; font-weight: bold; }
        textarea { width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; resize: vertical; }
        .btn-small { padding: 5px 10px; font-size: 0.8rem; cursor: pointer; }
    </style>
</head>
<body>
    <header>
        <div class="logo"><img src="images/logo.png" alt="Logo"></div>
        <nav><a href="index.html" onclick="sessionStorage.clear()">Logout</a></nav>
    </header>

    <main class="admin-main">
        <h2 style="color: var(--navy); margin-bottom: 20px;">ENGINEER MANAGEMENT PORTAL</h2>

        <section class="card">
            <h3>Client Rendez-vous & Inquiries</h3>
            <table>
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Service Requested</th>
                        <th>Status</th>
                        <th>Admin Response</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $inquiries = $conn->query("SELECT * FROM inquiries ORDER BY created_at DESC");
                    while($row = $inquiries->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['service_type']); ?></td>
                            <td>
                                <span class="status-<?php echo ($row['status'] == 'pending') ? 'pending' : 'done'; ?>">
                                    <?php echo strtoupper($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if($row['status'] == 'pending'): ?>
                                    <form action="respond_inquiry.php" method="POST">
                                        <input type="hidden" name="inquiry_id" value="<?php echo $row['id']; ?>">
                                        <textarea name="admin_reply" placeholder="Type your response (Date/Time)..." required></textarea>
                                <?php else: ?>
                                    <p style="font-style: italic; color: #555;"><?php echo htmlspecialchars($row['admin_reply']); ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($row['status'] == 'pending'): ?>
                                    <button type="submit" class="btn-red btn-small">Send Reply</button>
                                    </form>
                                <?php else: ?>
                                    ✅ Sent
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <div class="upload-grid">
            <div class="card">
                <h3>Add Store Material</h3>
                <form action="add_material.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="materialName" placeholder="Material Name" required style="width:100%; margin-bottom:10px; padding:8px;">
                    <input type="number" name="materialPrice" placeholder="Price (XAF)" required style="width:100%; margin-bottom:10px; padding:8px;">
                    <input type="file" name="materialImage" accept="image/*" required style="margin-bottom:10px;">
                    <button type="submit" class="btn-red" style="width:100%;">Upload to Store</button>
                </form>
            </div>

            <div class="card">
                <h3>Upload Project Video (About)</h3>
                <form action="upload_video.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="videoTitle" placeholder="Video Title" required style="width:100%; margin-bottom:10px; padding:8px;">
                    <input type="file" name="videoFile" accept="video/*" required style="margin-bottom:10px;">
                    <button type="submit" class="btn-red" style="width:100%;">Upload Video</button>
                </form>
            </div>

            <div class="card">
                <h3>Upload Blueprint (Vault)</h3>
                <form action="upload_blueprint.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="blueprintName" placeholder="Rename Blueprint" required style="width:100%; margin-bottom:10px; padding:8px;">
                    <input type="file" name="blueprintFile" accept=".pdf,image/*" required style="margin-bottom:10px;">
                    <button type="submit" class="btn-red" style="width:100%;">Add to Portfolio</button>
                </form>
            </div>

            <div class="card">
                <h3>Project Photo (About)</h3>
                <form action="upload_gallery.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="caption" placeholder="Photo Caption" required style="width:100%; margin-bottom:10px; padding:8px;">
                    <input type="file" name="galleryImage" accept="image/*" required style="margin-bottom:10px;">
                    <button type="submit" class="btn-red" style="width:100%;">Upload Photo</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        if (sessionStorage.getItem('isAdmin') !== 'true') {
            window.location.href = "login.php";
        }
    </script>
</body>
</html>