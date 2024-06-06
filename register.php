<!DOCTYPE html>
<html5 lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Register</title>
</head>
<body>
    <div class="register-page-wrapper">
        <div class="register-container">
            <?php
            session_start();
            require ('connect.php');

            if (isset($_REQUEST['name'])) {
                $name = stripslashes($_REQUEST['name']);
                $name = mysqli_real_escape_string($conn, $name);
                $email = stripslashes($_REQUEST['email']);
                $email = mysqli_real_escape_string($conn, $email);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($conn, $password);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT into `users` (name, email, password) VALUES ('$name', '$email', '$passwordHash')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "<div class='form'>
                          <h3>You are registered successfully.</h3>
                          <br/>Click here to <a href='login.php'>Login</a></div>";
                } else {
                    echo "<div class='form-error'>
                          <h3>Registration failed. Please try again.</h3>
                          </div>";
                }
            } else {
                ?>
                <div class="form-wrapper">
                    <h1>Registration</h1>
                    <form action="" method="post" name="registration" class="register-form">
                        <div class="input-group">
                            <i class="fa-solid fa-user icon"></i>
                            <input type="text" name="name" placeholder="Username" required />
                        </div>
                        <div class="input-group">
                            <i class="fa-solid fa-envelope icon"></i>
                            <input type="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="input-group">
                            <i class="fa-solid fa-lock icon"></i>
                            <input type="password" name="password" placeholder="Password" required />
                        </div>
                        <div class="action-group">
                            <input name="submit" type="submit" value="Register" class="submit-btn" />
                        </div>
                    </form>
                    <p class="rlogin-link">Already have an account? <a href='login.php'> Login Here</a></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html5>