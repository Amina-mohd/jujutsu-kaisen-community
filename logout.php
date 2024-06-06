<?php
session_start(); // Start the session.

if (isset($_POST['logout'])) {
    // Destroy the session.
    session_unset();
    session_destroy();

    // Redirect to index.php
    header('Location: index.php');
    exit();
}