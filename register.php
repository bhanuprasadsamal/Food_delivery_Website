<?php include('config/constants.php'); ?>

<html>
<head>
    <title>Customer Register Form</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section id="home">
        <div class="form-container">
            <form action="" method="POST" class="text-center">
                <h1 class="text-center">Customer Register</h1>
                <br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
                <br>
                <input type="text" name="full_name" placeholder="Enter Name" required>
                <input type="text" name="mobile" placeholder="Enter Mobile Number" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <input type="password" name="cpassword" placeholder="Confirm Password" required>
                <!-- <select name="user_type">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select> -->
                <input type="submit" name="submit" value="Register Now" class="form-btn">
                <p>already have an account? <a href="login.php">login now</a></p>
            </form>
        </div>
    </section>
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        // Get the data from register form
        $full_name = $_POST['full_name'];
        $mobile = $_POST['mobile'];
        $password = md5($_POST['password']); // password encryption with md5

        // SQL Query to save the data into database
        $sql = "INSERT INTO tbl_user SET
            full_name='$full_name',
            mobile='$mobile',
            password='$password'
        ";
        
        // Execute Query and Saving data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Check whether the data is inserted or not
        if($res==TRUE)
        {
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error text-center'>Register Successfully</div>";
            // Redirect page to Login page
            header("location:".SITEURL.'login.php');
        }
        else
        {
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error text-center'>Failed to Register</div>";
            // Redirect page to Register page
            header("location:".SITEURL.'register.php');
        }

    }
?>