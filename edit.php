<?php 
session_start();
include("config.php");

if(!isset($_SESSION['valid'])){
    header("Location: index.php");
    exit;
}

$id = $_SESSION['id'];

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $profile_image = $_FILES['profile_image']['name'];
    $target = "uploads/" . basename($profile_image);

    if (!empty($profile_image)) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target)) {
            $edit_query = mysqli_query($con, "UPDATE login SET Username='$username', Email='$email', Age='$age', Phone_number='$phone_number', Profile_image='$profile_image' WHERE id=$id");
        } else {
            echo "<div class='message'><p>Failed to upload image!</p></div><br>";
        }
    } else {
        $edit_query = mysqli_query($con, "UPDATE login SET Username='$username', Email='$email', Age='$age', Phone_number='$phone_number' WHERE id=$id");
    }

    if($edit_query){
        echo "<div class='message'><p>Profile Updated!</p></div><br>";
        echo "<a href='home.php'><button class='btn'>Go Home</button></a>";
    }
}

$query = mysqli_query($con, "SELECT * FROM login WHERE id='$id'");
$result = mysqli_fetch_assoc($query);
$res_Uname = $result['Username'];
$res_Email = $result['Email'];
$res_Age = $result['Age'];
$res_phone_number = $result['Phone_number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Dashboard CRUD Operation</a></p>
        </div>
        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Change Profile</header>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($res_Uname); ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($res_Email); ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($res_Age); ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" value="<?php echo htmlspecialchars($res_phone_number); ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" name="profile_image" id="profile_image">
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
