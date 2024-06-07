<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html5 lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jujutsu Kaisen Community website</title>

    <!-- Linking the Font Awesome library and stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="blog_style.css" type="text/css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap');
    </style>
</head>
<body>
    <header>
        <!-- Hamburger Menu Icon -->
        <div class="hamburger-menu">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div id="navbar">
            <!-- Close Icon -->
            <div class="close-menu">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <!--Navigation links-->
            <a class="nav-link" href="http://localhost/jujutsu-kaisen-community/index.php#home">
                <div class="nav-img-container">
                    <img class="nav-img" src="images/mark (edit).png" alt="Home">
                    <span class="nav-text">Home</span>
                </div>
            </a>
            
            <a class="nav-link" href="http://localhost/jujutsu-kaisen-community/index.php#story">
                <div class="nav-img-container">
                    <img class="nav-img" src="images/mark (edit).png" alt="Story">
                    <span class="nav-text">Story</span>
                </div>
            </a>
            
            <a class="nav-link" href="http://localhost/jujutsu-kaisen-community/index.php#characters">
                <div class="nav-img-container">
                    <img class="nav-img" src="images/mark (edit).png" alt="Characters">
                    <span class="nav-text">Characters</span>
                </div>
            </a>
            
            <a class="nav-link" href="blog.php">
                <div class="nav-img-container">
                    <img class="nav-img" src="images/mark (edit).png" alt="Blog">
                    <span class="nav-text">Blog <i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                </div>
            </a>
        </div>
    </header>

    <div id="loading" class="loading-screen">
        <img src="images/face mark (edit).png" alt="Loading" />
        <p>Loading...</p>
    </div>

    <!--Javascript-->
    <script src="script.js" type="text/javascript"></script>
</body>
</html5>
