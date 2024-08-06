<?php 
include("config.php");
if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $profile_image = $_FILES['profile_image']['name'];
    $target = "uploads/" . basename($profile_image);

    $verify_query = mysqli_query($con, "SELECT Email FROM login WHERE Email='$email'");

    if(mysqli_num_rows($verify_query) != 0){
        echo "<div class='message'><p>This email is already registered. Please try another one.</p></div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target)) {
            $query = "INSERT INTO login (Username, Email, Age, Phone_number, Password, Profile_image) 
                      VALUES ('$username', '$email', '$age', '$phone_number', '$password', '$profile_image')";
            mysqli_query($con, $query);
            echo "<div class='message1'><p>Registration Successful!</p></div><br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
        } else {
            echo "<div class='message'><p>Failed to upload image!</p></div><br>";
        }
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Register</header>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="phone_number">Phone Number</label>
                    <input type="number" name="phone_number" id="phone_number" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <span class="password-toggle" onclick="togglePassword()">Show</span>
                </div>
                <div class="field input">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" name="profile_image" id="profile_image" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Already have an account? <a href="index.php">Login Now</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleText = document.querySelector(".password-toggle");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleText.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleText.textContent = "Show";
            }
        }
    </script>
</body>
</html>
<?php } ?>
