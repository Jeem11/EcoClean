<?php
include 'header.php';
include 'DBLaundryConnect.php'; // Include your database connection file

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $targetFile);

        // Insert into the database
        $stmt = $conn->prepare("INSERT INTO image_posts (description, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $description, $targetFile);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all posts from the database
$posts = [];
$result = $conn->query("SELECT * FROM image_posts ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Owner Interface</title>
    <link rel="stylesheet" href="Odashboard.css"> 
</head>
<body>
    <div class="logo">
        <img src="logo.png" alt="Logo"> 
    </div>
    <h1>Welcome to EcoClean!</h1>

    <div class="container">
        <div class="post-form">
            <form action="your_script.php" method="POST" enctype="multipart/form-data">
                <textarea name="description" placeholder="What's on your mind?" required></textarea>
                <input type="file" name="image" accept="image/*" required>
                <button type="submit">Post</button>
            </form>
        </div>

        <!-- Display posts -->
        <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><?php echo htmlspecialchars($post['description']); ?></p>
            <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image">
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Your background overlays -->
    <script src="scripts.js"></script> <!-- Optional: Include JavaScript if needed -->
</body>
</html>

<!--CREATE TABLE image_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
        -->