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
    hi
    <div class="center">
        <h1>ADMIN LOGIN PANEL</h1>

        <form action="#" method="POST">
        <div class="form">
            <input type="text" name="username" class="textfield" placeholder ="username"required>
            <input type="password" name="password" class="textfield" placeholder="password" required>
            <div class="forgetpass"><a href="#" class="link" onclick="message()">Forgert Password?</a></div>

            <input type="submit" name= 'login' value="Login" class="btn">
       </div>
    </div>
    </form>
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

    // Hash the user's input password using SHA2 (assuming SHA2 is used in SQL)
    $hashedPassword = hash('sha256', $password);

    $query = "SELECT * FROM Admin WHERE username = '$username'";

    $result = mysqli_query($conn, $query);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        if($row) {
            // Compare the hashed password from the database with the hashed user input
            if($hashedPassword === $row['password']) {
               
                $_SESSION['username'] = $username;
                header('location:display.php');
                echo "<script>alert('Login Successful!');</script>";
            } else {
               
                $_SESSION['username'] = $username;
                header('location:login.php');
                echo "<script>alert('Login Failed!');</script>";
            }
        } else {
            echo "<script>alert('Username not found!');</script>";
        }
    } else {
        echo "<script>alert('Query failed!');</script>";
    }
}

 ?>