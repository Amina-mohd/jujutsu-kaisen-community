<?php
session_start();
require 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    $response = ['success' => false, 'message' => 'Error: User is not logged in.'];
    echo json_encode($response);
    exit;
}

// Validate title and content
$title = !empty($_POST['title']) ? trim($_POST['title']) : null;
$content = !empty($_POST['content']) ? trim($_POST['content']) : null;

// Check if file was uploaded without errors
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Define the allowed file types
    $allowed = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];

    // Verify file extension
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed)) {
        $response = ['success' => false, 'message' => 'Error: Please select a valid file format.'];
        echo json_encode($response);
        exit;
    }

    // Verify file size - 5MB maximum
    $maxsize = 5 * 1024 * 1024;
    if ($_FILES['image']['size'] > $maxsize) {
        $response = ['success' => false, 'message' => 'Error: File size is larger than the allowed limit.'];
        echo json_encode($response);
        exit;
    }

    // Verify MIME type of the file
    if (in_array($_FILES['image']['type'], $allowed)) {
        // Generate a unique name for the file
        $fileName = uniqid() . '-' . $_FILES['image']['name'];

        // Check whether file exists before uploading it
        if (file_exists("uploads/" . $fileName)) {
            $response = ['success' => false, 'message' => $fileName . ' already exists.'];
            echo json_encode($response);
            exit;
        } else {
            // Move the file
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $fileName);

            // Insert into the database
            $stmt = $conn->prepare('INSERT INTO posts (userID, title, content, date) VALUES (?, ?, ?, NOW())');
            $stmt->bind_param('iss', $_SESSION['userID'], $title, $content);
            if ($stmt->execute()) {
                // Get the last inserted post ID
                $last_id = $stmt->insert_id;

                // Insert into the images table
                $stmt = $conn->prepare('INSERT INTO images (postID, userID, fileName, time) VALUES (?, ?, ?, NOW())');
                $stmt->bind_param('iis', $last_id, $_SESSION['userID'], $fileName);
                if ($stmt->execute()) {
                    header('Location: view_post.php?id=' . $last_id);
                    exit;
                } else {
                    $response = ['success' => false, 'message' => 'Error: There was an error inserting the image record.'];
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response = ['success' => false, 'message' => 'Error: There was an error inserting the post record.'];
                echo json_encode($response);
                exit;
            }
        }
    } else {
        $response = ['success' => false, 'message' => 'Error: There was an error uploading your file. Please try again.'];
        echo json_encode($response);
        exit;
    }
} else {
    $response = ['success' => false, 'message' => 'Error: ' . $_FILES['image']['error']];
    echo json_encode($response);
    exit;
}