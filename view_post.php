<html5 lang="en">
<head>
    <link rel="stylesheet" href="blog_style.css" type="text/css">
</head>
<body>
    <div class="post-wrapper">
        <?php
        require 'connect.php';

        // Get the post ID from the URL
        $postId = isset($_GET['id']) ? $_GET['id'] : die('Error: Post ID not specified.');

        // Fetch the post from the database
        $stmt = $conn->prepare('SELECT posts.title, posts.content, posts.date, images.fileName FROM posts LEFT JOIN images ON posts.id = images.postID WHERE posts.id = ?');
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        // Check if the post exists
        if (!$post) {
            die('Error: Post not found.');
        }

        // Display the post
        echo "<div class='post-header'><h1>" . htmlspecialchars($post['title']) . "</h1></div>";
        echo "<hr style='border: 0; height: 1px; background-color: #8b0000; width: 40%; margin: 0 auto;'>";
        echo "<div class='post-content'><p>" . nl2br(htmlspecialchars($post['content'])) . "</p></div>";

        // Check if the image file exists before displaying it
        $imagePath = 'uploads/' . $post['fileName'];
        if (file_exists($imagePath)) {
            echo "<div class='post-image'><img src='" . htmlspecialchars($imagePath) . "' alt='Post Image'></div>";
        } else {
            echo "<div class='image-not-found'><p>Image not found.</p></div>";
        }

        echo "<div class='post-date'><p>Posted on " . $post['date'] . "</p></div>";

        // Add a button to go back to the index page
        echo "<div class='back-button' style='display: flex; justify-content: center;'><a href='blog.php'><button>Back to Posts</button></a></div>";

        // Close the connection
        $conn->close();
        ?>
    </div>
    <script src="script.js" type="text/javascript"></script>
</body>
</html5>