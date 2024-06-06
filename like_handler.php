<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'connect.php';

$response = ['success' => false, 'liked' => false, 'likes' => 0];

if (isset($_POST['postID']) && isset($_SESSION['userID'])) {
    $postID = $_POST['postID'];
    $userID = $_SESSION['userID'];

    try {
        // Start transaction
        $conn->begin_transaction();

        // Check if the user has already liked the post
        $checkLike = $conn->prepare("SELECT * FROM likes WHERE postID = ? AND userID = ?");
        $checkLike->bind_param("ii", $postID, $userID);
        $checkLike->execute();
        $result = $checkLike->get_result();

        if ($result->num_rows === 0) {
            // If not liked, insert like
            $insertLike = $conn->prepare("INSERT INTO likes (userID, postID) VALUES (?, ?)");
            $insertLike->bind_param("ii", $userID, $postID);
            $insertLike->execute();
            $response['liked'] = true;
        } else {
            // If already liked, remove like
            $deleteLike = $conn->prepare("DELETE FROM likes WHERE postID = ? AND userID = ?");
            $deleteLike->bind_param("ii", $postID, $userID);
            $deleteLike->execute();
        }

        // Get the current likes count
        $likesQuery = $conn->prepare("SELECT COUNT(*) as likesCount FROM likes WHERE postID = ?");
        $likesQuery->bind_param("i", $postID);
        $likesQuery->execute();
        $likesResult = $likesQuery->get_result();
        $likesRow = $likesResult->fetch_assoc();
        $response['likes'] = $likesRow['likesCount'];

        // Commit transaction
        $conn->commit();
        $response['success'] = true;
    } catch (Exception $e) {
        // Rollback transaction if an exception occurs
        $conn->rollback();
        $response['error'] = $e->getMessage();
    }
} else {
    $response['error'] = 'Post ID or User ID not set.';
}

$conn->close();

// Return the response as JSON
echo json_encode($response);