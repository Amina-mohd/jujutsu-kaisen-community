<?php
require 'connect.php';
include_once 'header.php';
require_once 'php-google-translate-free-master/src/GoogleTranslate.php';
use Statickidz\GoogleTranslate;


$sql = "SELECT posts.id, posts.title, posts.content, posts.date, images.fileName, users.name, users.image FROM posts LEFT JOIN images ON posts.id = images.postID LEFT JOIN users ON posts.userID = users.userID GROUP BY posts.id ORDER BY posts.date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html5 lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div id="navbar">
            <a class="nav-link" href="index.php">
                <div class="nav-img-container">
                    <img class="nav-img nav-img-black" src="images/mark (edit).png" alt="Home">
                    <span class="nav-text">Home</span>
                </div>
            </a>
            
            <a class="nav-link" href="index.php#story">
                <div class="nav-img-container">
                    <img class="nav-img nav-img-black" src="images/mark (edit).png" alt="Story">
                    <span class="nav-text">Story</span>
                </div>
            </a>
            
            <a class="nav-link" href="index.php#characters">
                <div class="nav-img-container">
                    <img class="nav-img nav-img-black" src="images/mark (edit).png" alt="Characters">
                    <span class="nav-text">Characters</span>
                </div>
            </a>
            
            <a class="nav-link" href="blog.php">
                <div class="nav-img-container">
                    <img class="nav-img nav-img-black" src="images/mark (edit).png" alt="Blog">
                    <span class="nav-text">Blog <i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                </div>
            </a>
        </div>
    </header>

    <main class="blog-container">
        <div class="heading-container fade-in">
            <img src="images/mark 1.png" alt="Left Decorative Image" class="decorative-image left-image">
            <h1>Blog</h1>
            <img src="images/mark 2.png" alt="Right Decorative Image" class="decorative-image right-image">
        </div>

        <?php while ($row = $result->fetch_assoc()):
            $userName = htmlspecialchars($row["name"]);
            $userImage = !empty($row['image']) ? $row['image'] : null; // Check if the user has a profile picture
            ?>
            <article class="post">
                <!-- Display the user's name and profile picture or icon -->
                <div class="user-info">
                    <?php if ($userImage): ?>
                        <img src="<?= $userImage; ?>" alt="User Image" class="user-image">
                    <?php else: ?>
                        <!-- Display the Font Awesome icon if there is no profile picture -->
                        <i class="fa-solid fa-user users-icon"></i>
                    <?php endif; ?>
                    <span class="user-name"><?= $userName; ?></span>
                </div>
                <hr />
                <h2 class="post-title"><?= htmlspecialchars($row["title"]); ?></h2>
                <p class="post-content"><?= htmlspecialchars($row["content"]); ?></p>
                <button class="translate-btn" data-translated="false"><span class="material-symbols-outlined">g_translate</span>Translate</button>
                <?php
                $imagePath = 'uploads/' . $row['fileName'];
                if (file_exists($imagePath)): ?>
                    <img src="<?= htmlspecialchars($imagePath); ?>" alt="Post Image" class="post-image">
                <?php else: ?>
                    <p class="image-not-found">Image not found.</p>
                <?php endif; ?>

                <?php
                // Fetch the likes count and liked status for the current post
                $likes_sql = "SELECT COUNT(*) as likesCount, EXISTS(SELECT 1 FROM likes WHERE postID = ? AND userID = ?) as isLiked FROM likes WHERE postID = ?";
                $likes_stmt = $conn->prepare($likes_sql);
                $likes_stmt->bind_param("iii", $row['id'], $_SESSION['userID'], $row['id']);
                $likes_stmt->execute();
                $likes_result = $likes_stmt->get_result();
                $likes_row = $likes_result->fetch_assoc();
                $likes_count = $likes_row['likesCount'];
                $is_liked = $likes_row['isLiked'];
                ?>
                
                <div class="post-footer">
                    <div class="like-section">
                        <!-- Update the heart icon's class based on the liked status -->
                        <i class="fa-solid fa-heart like-btn <?= $is_liked ? 'liked' : '' ?>" data-postid="<?= $row['id']; ?>"></i>
                        <span class="likes-count"><?= $likes_count ?> Likes</span>
                    </div>
                    
                    <div class="time-section">
                        <p class="post-date">Posted on <?= $row["date"]; ?></p>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
        <a href="create_post.php" class="create-post-link"><i class="fa-solid fa-pen-to-square"></i></a>
    </main>
    <?php $conn->close(); ?>

    <script>
        $(document).ready(function () {
            $('.translate-btn').click(function () {
                var translateButton = $(this);
                var postTitle = translateButton.siblings('.post-title');
                var postContent = translateButton.siblings('.post-content');

                // Check if the content is already translated
                if (!translateButton.data('translated')) {
                    // Store the original text
                    var originalTitle = postTitle.text();
                    var originalContent = postContent.text();
                    translateButton.data('original-title', originalTitle);
                    translateButton.data('original-content', originalContent);

                    // Translate the content
                    $.ajax({
                        url: 'translate.php',
                        type: 'POST',
                        data: { title: originalTitle, content: originalContent },
                        success: function (response) {
                            var translated = JSON.parse(response);
                            postTitle.text(translated.title);
                            postContent.text(translated.content);
                            translateButton.text('Show Original');
                            translateButton.data('translated', true);
                        },
                        error: function (xhr, status, error) {
                            console.error('Translation error: ' + error);
                        }
                    });
                } else {
                    // Revert to the original text
                    postTitle.text(translateButton.data('original-title'));
                    postContent.text(translateButton.data('original-content'));
                    translateButton.text('Translate');
                    translateButton.data('translated', false);
                }
            });


            // Add this script for the like button functionality
            $('.like-btn').click(function () {
                var likeButton = $(this);
                if (likeButton.hasClass('processing')) return;
                likeButton.addClass('processing');

                // Check if userID is set, which means the user is logged in
                var userID = <?php echo json_encode(isset($_SESSION['userID']) ? $_SESSION['userID'] : null); ?>;
                if (!userID) {
                    alert('Please log in to like posts.');
                    likeButton.removeClass('processing');
                    return; // Exit the function if userID is not set
                }

                var postID = likeButton.data('postid');

                $.post('like_handler.php', { postID: postID, userID: userID }, function (response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        likeButton.toggleClass('liked', data.liked);
                        likeButton.siblings('.likes-count').text(data.likes + ' Likes');
                    } else {
                        console.error('Error liking the post: ', data.error);
                    }

                    likeButton.removeClass('processing');
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error liking the post: ' + textStatus);
                    likeButton.removeClass('processing');
                });
            });
        });
    </script>
</body>
</html5>