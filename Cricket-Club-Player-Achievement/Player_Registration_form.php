<?php
include('database.php');
// session_start();

// echo "<h1>Welcome ".$_SESSION['username']."</h1>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Info</title>
    <link rel="icon" type="png" href="./nsulogo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">Player Registration Form</div>
        
        <form action="#" method="POST">
        <div class="form">
            <h4 class="section">Personal Information</h4>

            <div class="inputField">
                <label>First Name</label>
                <input type="text" class="input" placeholder=" Enter First Name" name="first_name" required>
            </div>  

            <div class="inputField">
                <label>Middle Name</label>
                <input type="text" class="input" placeholder=" Enter Middle Name" name="middle_name">
            </div>  

            <div class="inputField">
                <label>Last Name</label>
                <input type="text" class="input" placeholder=" Enter Last Name" name="last_name" required>
            </div>  

            <div class="inputField">
                <label>Email</label>
                <input type="text" class="input" placeholder=" Enter Email " name="email" required>
            </div>  

            <div class="inputField">
                <label>Username</label>
                <input type="text" class="input" placeholder=" Enter Username" name="username" required>
            </div>

            <div class="inputField">
                <label>Password</label>
                <input type="password" class="input" placeholder=" Enter Password" name="password" required>
            </div>

            <div class="inputField">
                <label>Phone Number</label>
                <input type="number" class="input" placeholder=" Enter Phone Number" name="phone_number">
            </div>  

            <div class="inputField">
                <label>Nationality</label>
                <input type="text" class="input" placeholder=" Enter Nationality" name="nationality" required>
            </div>

            <div class="inputField">
                <label>Date of Birth</label>
                <input type="date" class="input" placeholder=" Enter Date of Birth" name="dob" required>
            </div>

            <div class="inputField">
                <label>Age</label>
                <input type="number" class="input" placeholder=" Enter Age" name="age" required>
            </div> 

            <h4 class="section">Educational Qualification</h4>

            <div class="inputField">
                <label>Educational Degree</label>
                <input type="text" class="input" placeholder=" Enter Degree Name" name="degree">
            </div>

            <div class="inputField">
                <label>Graduation Institute</label>
                <input type="text" class="input" placeholder=" Enter Institute Name" name="institution">
            </div>

            <div class="inputField">
                <label>Passing/Expected Year</label>
                <input type="text" class="input" placeholder=" Enter Passing/Expected Year" name="passing_year">
            </div> 

            <h4 class="section">Training Information</h4>
            <div class="inputField">
                <label>Sports Academy</label>
                <input type="text" class="input" placeholder=" Enter Academy Name" name="academy">
            </div>
            
            <div class="inputField">
                <label>Specialization</label>
                <input type="text" class="input" placeholder=" Enter Specialization" name="specialization" required>
            </div> 
            

            <div class="inputField">
                <input type="submit" value="INSERT" class="btn" name="insert">
            </div>
        </div>
        </form>
    </div>
</body>
</html>

<?php
include("database.php");
// session_start();
// $username = $_SESSION['username'];
// if (!$username) {
//     header('location:login.php');
// }

if (isset($_POST['insert'])) {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $nationality = $_POST['nationality'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $degree = $_POST['degree'];
    $institution = $_POST['institution'];
    $passing_year = $_POST['passing_year'];
    $academy = $_POST['academy'];
    $specialization = $_POST['specialization'];
    $login_username = $_POST['username'];
    $login_password = hash('sha256', $_POST['password']); // Hash the password using SHA-256

    // Check for empty fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($nationality) || empty($dob) || empty($age) || empty($specialization) || empty($login_username) || empty($login_password)) {
        echo "<script>alert('Please fill all required fields')</script>";
    } else {
        // Construct SQL queries
        $query_basic = "INSERT INTO Player (first_name, middle_name, last_name, email, phone_number, nationality, dob, age) VALUES('$first_name', '$middle_name', '$last_name', '$email', '$phone_number', '$nationality', '$dob', '$age')";
        
        // Execute SQL query for Players table
        $result1 = mysqli_query($conn, $query_basic);

        // Check for query execution success
        if ($result1) {
            // Insertion into Players table successful, get the last inserted player_id
            $player_id = mysqli_insert_id($conn);

            // Construct SQL queries for Player_Education and Player_Training tables
            $query_education = "INSERT INTO Player_Education (player_id, degree, institution, passing_year) VALUES('$player_id', '$degree', '$institution', '$passing_year')";
            $query_training = "INSERT INTO Player_Training (player_id, academy, specialization) VALUES('$player_id', '$academy', '$specialization')";
            $query_login = "INSERT INTO Player_Login (player_id, username, password) VALUES('$player_id','$login_username', '$login_password')";

            // Execute SQL queries for Player_Education, Player_Training, and Player_Login tables
            $result2 = mysqli_query($conn, $query_education);
            $result3 = mysqli_query($conn, $query_training);
            $result4 = mysqli_query($conn, $query_login);

            // Check for query execution success
            if ($result2 && $result3 && $result4) {
                // Insert into Registration and Contracts tables
                $query_registration = "INSERT INTO Registration (player_id) VALUES ('$player_id')";
                $query_contract = "INSERT INTO Contracts (player_id) VALUES ('$player_id')";
                
                $result5 = mysqli_query($conn, $query_registration);
                $result6 = mysqli_query($conn, $query_contract);

                if ($result5 && $result6) {
                    echo "<script>alert('Inserted in database successfully!');</script>";
                    header('location:display.php');
                } else {
                    echo "<script>alert('Insertion Failed!');</script>";
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('Insertion Failed!');</script>";
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Error inserting into Players table
            echo "<script>alert('Insertion Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
