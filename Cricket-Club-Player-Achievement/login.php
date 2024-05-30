<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login-style.css">
    <title>ADMIN LOGIN PANEL</title>
</head>
<body>
    <div class="center">
        <h1>LOGIN</h1>
        <form action="#" method="POST">
            <div class="form">
                <input type="text" name="username" class="textfield" placeholder="username" required>
                <input type="password" name="password" class="textfield" placeholder="password" required>
                <div class="forgetpass"><a href="#" class="link" onclick="message()">Forget Password?</a></div>
                <input type="submit" name='login' value="Login" class="btn">
            </div>
        </form>
    </div>
    <script>
        function message(){
            alert("Please contact the system administrator");
        }
    </script>
</body>
</html>

<?php
include("database.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the user's input password using SHA2
    $hashedPassword = hash('sha256', $password);

    // Query to check in Player_Login
    $query = "SELECT * FROM Player_Login WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Query to check in Login (admin table)
    $query2 = "SELECT * FROM Login WHERE username = '$username'";
    $result2 = mysqli_query($conn, $query2);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row['usertype'] == 'player') {
            // Compare the hashed password from the database with the hashed user input
            if($password === $row['password']) {
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = 'player';
                echo "<script>alert('Logged in as Player!');</script>";
                header('location:player_profile.php');
                exit;
            } else {
                echo "<script>alert('Login Failed! Incorrect Password.');</script>";
            }
        }
    } 

    if($result2 && mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        if($row2['usertype'] == 'admin') {
            // Compare the hashed password from the database with the hashed user input
            if($hashedPassword === $row2['password']) {
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = 'admin';
                echo "<script>alert('Logged in as Admin!');</script>";
                header('location:admin_dashboard.php');
                exit;
            } else {
                echo "<script>alert('Login Failed! Incorrect Password.');</script>";
            }
        }
    } 

    echo "<script>alert('Login Failed! User not found.');</script>";
}
?>
