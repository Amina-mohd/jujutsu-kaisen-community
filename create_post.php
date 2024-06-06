<html5 lang="en">
<head>
    <title>Create a New Post</title>
    <!-- Linking the Font Awesome library and stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="blog_style.css" type="text/css">
</head>
<body>
    <main class="main-content">
        <section class="post-creation-container">
            <header class="form-header">
                <h1>Create a New Post</h1>
            </header>
            <form action="post.php" method="post" enctype="multipart/form-data" id="upload-form" class="post-form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter post title" required>
                </div>
                
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" placeholder="Write your content here..." required></textarea>
                </div>
                
                <div class="form-group">
                    <label class="button" for="fileElem">Select files</label>
                    <input type="file" id="fileElem" name="image" multiple accept="image/*">
                </div>
                
                <div class="form-actions">
                    <input type="button" class="cancel-btn" value="Cancel" onclick="window.location.href='blog.php';">
                    <input type="submit" class="submit-btn" name="submit" value="Create Post">
                </div>
            </form>
        </section>
    </main>
    <script src="script.js" type="text/javascript"></script>
</body>
</html5>