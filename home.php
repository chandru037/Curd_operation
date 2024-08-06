<?php 
session_start();
include("config.php");

if(!isset($_SESSION['valid'])){
    header("Location: index.php");
    exit;
}

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM login WHERE id='$id'");

if(mysqli_num_rows($query) > 0) {
    $result = mysqli_fetch_assoc($query);
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
    $res_phone_number = $result['Phone_number'];
    $res_profile_image = $result['Profile_image']; 
} else {
    echo "<p>Error fetching user data</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Dashboard CRUD Operation</a></p>
        </div>
        <div class="right-links">
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
            <div class="box">
            <img src="uploads/<?php echo isset($res_profile_image) ? $res_profile_image : 'default.jpg'; ?>" alt="Profile Image" class="profile-image">
            </div>
            </div><br><br>
            <div class="bottom">
            <div class="box">
                    <p>Hello <b><?php echo isset($res_Uname) ? $res_Uname : ''; ?></b>, Welcome</p>
                </div><br>
                <div class="box">
                    <p>Your email is <b><?php echo isset($res_Email) ? $res_Email : ''; ?></b>.</p>
                </div><br>
                <div class="box">
                    <p>And you are <b><?php echo isset($res_Age) ? $res_Age : ''; ?> years old</b>.</p>
                </div><br>
                <div class="box">
                    <p>And your Phone Number is <b><?php echo isset($res_phone_number) ? $res_phone_number : ''; ?></b>.</p>
                </div>
            <div class="profile-change">
                <a href='edit.php?id=<?php echo $id; ?>'><button class="btn">Change Profile</button></a>
            </div>
        </div>
    </main>
</body>
</html>
