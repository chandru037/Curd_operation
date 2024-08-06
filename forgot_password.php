<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
            include("config.php");
            if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con, $_POST['email']);

                $verify_query = mysqli_query($con, "SELECT * FROM login WHERE Email='$email'");
                
                if(mysqli_num_rows($verify_query) == 0){
                    echo "<div class='message'><p>No account associated with this email</p></div><br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                } else {
                    $row = mysqli_fetch_assoc($verify_query);
                    $password = $row['Password'];
                    echo "<div class='message'><p>Your password is: $password</p></div><br>";
                    echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
                }
            } else {
            ?>
            <header>Forgot Password</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Submit" required>
                </div>
                <div class="links">
                    Remember your password? <a href="index.php">Login</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</body>
</html>
