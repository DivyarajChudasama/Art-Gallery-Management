<?php
// Connect to database using PDO
$host = 'localhost';
$dbname = 'my_gallery';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data

    // Check if an image has been uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get file information
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Allow only specific file types
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($file_ext, $allowed_ext) === false) {
            echo 'Error: File type not allowed.';
            exit();
        }

        // Set file path and move uploaded file to folder
        $file_path = 'admin dashboard for art gallery/' . $file_name;
        move_uploaded_file($file_tmp, $file_path);

        // Insert data into database
        $stmt = $db->prepare('INSERT INTO artwork (meta) VALUES (?)');
        $stmt->execute([ $file_path]);

        // Show success message
        echo 'Artwork added successfully!';
    } else {
        echo 'Error: Please select an image to upload.';
    }
}
?>
