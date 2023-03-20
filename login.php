<?php include('config/constants.php'); ?>

<html>
    <head>
        <title>Customer Login Form</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <section id="home">
            <div class="form-container">
            <form action="" method="POST" class="text-center">
                <h1 class="text-center">Customer Login</h1>
                <br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                ?>
                <br>
                    <input type="text" name="mobile" placeholder="Enter Mobile Number" required>
                    <input type="password" name="password" placeholder="Enter Password" required>
                    <input type="submit" name="submit" value="Login Now" class="form-btn">
                    <p>don't have an account? <a href="register.php">register now</a></p>
                    <br><br>
            </form>
            </div>
        </section>
    </body>
</html>

<?php
        if(isset($_POST['submit']))
        {
            $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
            $raw_password = md5($_POST['password']);
            $password = mysqli_real_escape_string($conn,$raw_password);

            $sql = "SELECT * FROM tbl_user WHERE mobile='$mobile' AND password='$password'";
            
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            
            if($count==1)
            {
                $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
                            
                // Check whether the user is logged in or not
                $_SESSION['user'] = $mobile;

                // Redirect to Homepage/Dashboard
                header('location:'.SITEURL.'index.php');
            }   
                else
                {
                    $_SESSION['login'] = "<div class='error text-center'>Incorrect Mobile Number or Password</div>";
                    header('location:'.SITEURL.'login.php');
                }
        }
?>