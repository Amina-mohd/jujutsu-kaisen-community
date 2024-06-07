<?php
// Initialize the session
session_start();

include 'connect.php';

// Google OAuth credentials
$google_oauth_client_id = '444567349697-tc5i2drkkkfako4t5pqiiu10obpqu9qh.apps.googleusercontent.com';
$google_oauth_client_secret = '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';
$google_oauth_redirect_uri = 'https://localhost/jujutsu-kaisen-community/google-oauth.php';
$google_oauth_version = 'v3';

// If the user is not already logged in via Google and the code parameter is present
if (!isset($_SESSION['google_loggedin']) && isset($_GET['code']) && !empty($_GET['code'])) {
    // Execute cURL request to retrieve the access token
    $params = [
        'code' => $_GET['code'],
        'client_id' => $google_oauth_client_id,
        'client_secret' => $google_oauth_client_secret,
        'redirect_uri' => $google_oauth_redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);

    // Make sure access token is valid
    if (!empty($response['access_token'])) {
        // Execute cURL request to retrieve the user info associated with the Google account
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        $response = curl_exec($ch);
        curl_close($ch);

        $profile = json_decode($response, true);

        // Making sure if the profile data exists
        if (!empty($profile['email'])) {
            // Authenticate the user
            $_SESSION['google_loggedin'] = TRUE;
            $_SESSION['google_email'] = $profile['email'];
            $_SESSION['name'] = $profile['name'];

            // Store the profile picture URL in the session if it's available
            if (!empty($profile['picture'])) {
                $_SESSION['google_picture'] = $profile['picture'];
            }

            // Check if the user's email is already in the database
            $sql = "SELECT userID FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $profile['email']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User exists, fetch userID
                $row = $result->fetch_assoc();
                $_SESSION['userID'] = $row['userID'];
            } else {
                // User does not exist, create new user and fetch userID
                $sql = "INSERT INTO users (name, email, image) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $profile['name'], $profile['email'], $profile['picture']);
                $stmt->execute();
                $_SESSION['userID'] = $conn->insert_id;
            }

            // Close the statement
            $stmt->close();

            // Redirect to the main page
            header('Location: index.php');
            exit;
        } else {
            exit('Could not retrieve profile information! Please try again later!');
        }
    } else {
        exit('Invalid access token! Please try again later!');
    }
} else {
    // Define params and redirect to Google Authentication page
    $params = [
        'response_type' => 'code',
        'client_id' => $google_oauth_client_id,
        'redirect_uri' => $google_oauth_redirect_uri,
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
    exit;
}
