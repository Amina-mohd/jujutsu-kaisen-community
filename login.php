<!DOCTYPE html>
<html5 lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Login</title>
</head>
<body>
    <div class="login-page-wrapper">
        <div class="login-container">
            <?php
            session_start();
            require ('connect.php');

            if (isset($_POST['name'])) {
                $name = stripslashes($_REQUEST['name']);
                $name = mysqli_real_escape_string($conn, $name);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($conn, $password);

                $query = "SELECT * FROM `users` WHERE name='$name'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $user = $result->fetch_assoc();

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['userID'] = $user['userID'];
                    $_SESSION['user_logged_in'] = true;
                    header("Location: index.php");
                } else {
                    echo "<div class='form-error'>
                          <h3>Username/password is incorrect.</h3>
                          <p>Click here to either <a href='login.php'>Login</a> or <a href='register.php'>Register</a></p>
                          </div>";
                }
            } else {
                ?>
                <div class="form-wrapper">
                    <h1>Log In</h1>
                    <form action="" method="post" name="login" class="login-form">
                        <div class="input-group">
                            <div class="icon-container">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <input type="text" name="name" placeholder="Username" required />
                        </div>

                        <div class="input-group">
                            <div class="icon-container">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" name="password" placeholder="Password" required />
                        </div>

                        <div class="action-group">
                            <input name="submit" type="submit" value="Login" class="submit-btn" />
                            <a href="google-oauth.php" class="google-btn">Sign in with Google</a>
                        </div>
                    </form>
                    <p class="register-link">Not registered yet? <a href='register.php'>Register Here</a></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html5>