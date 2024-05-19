<?php
    include("database.php");

    session_start();

    echo "<h1>Welcome ".$_SESSION['username']."</h1>";

    $username = $_SESSION['username'];

    if($username == true)
    {
        
    }else{
        header('location:login.php');
    }

    $player_id = $_GET['player_id'];

    $query_player = "SELECT * FROM Player NATURAL JOIN Player_Education NATURAL JOIN Player_Training WHERE player_id = '$player_id'";
    
    $result = mysqli_query($conn, $query_player);

    $row = mysqli_fetch_assoc($result);
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
        <div class="title">UPDATE Player Info</div>
        
        <form action="#" method="POST">
        <div class="form">
            <h4 class="section">Personal Information</h4>

            <!-- <div class="inputField">
                <label>Player ID</label>
                <input type="number" class="input" placeholder=" Enter Player ID" name="player_id" required>
            </div> -->
            
            <div class="inputField">
                <label>First Name</label>
                <input type="text" value= "<?php echo $row['first_name'];?>" class="input" placeholder=" Enter First Name" name="first_name" required>
            </div>  

            <div class="inputField">
                <label>Middle Name</label>
                <input type="text" value= "<?php echo $row['middle_name'];?>"class="input" placeholder=" Enter Middle Name" name="middle_name">
            </div>  

            <div class="inputField">
                <label>Last Name</label>
                <input type="Last Name" value= "<?php echo $row['last_name'];?>" class="input" placeholder=" Enter Last Name" name="last_name" required>
            </div>  

            <div class="inputField">
                <label>Email</label>
                <input type="text" value= "<?php echo $row['email'];?>" class="input"  placeholder=" Enter Email " name="email" required>
            </div>  

            <div class="inputField">
                <label>Phone Number</label>
                <input type="number" value= "<?php echo $row['phone_number'];?>" class="input"  placeholder=" Enter Phone Number" name="phone_number">
            </div>  
            <div class="inputField">
                <label>Nationality</label>
                <input type="text" value= "<?php echo $row['nationality'];?>" class="input" placeholder=" Enter Nationality" name="nationality" required>
            </div>

            <div class="inputField">
                <label>Date of Birth</label>
                <input type="date" value= "<?php echo $row['dob'];?>" class="input" placeholder=" Enter Date of Birth" name="dob" required>
            </div>

            <div class="inputField">
                <label>Age</label>
                <input type="number" value= "<?php echo $row['age'];?>" class="input" placeholder=" Enter Age" name="age" required>
            </div> 

            <h4 class="section">Educational Qualification</h4>

            <div class="inputField">
                <label>Educational Degree</label>
                <input type="text" value= "<?php echo $row['degree'];?>" class="input" placeholder=" Enter Degree Name" name="degree" >
            </div>

            <div class="inputField">
                <label>Graduation Institute</label>
                <input type="text" value= "<?php echo $row['institute'];?>" class="input" placeholder=" Enter Institute Name" name="institute">
            </div>

            <div class="inputField">
                <label>Passing/Expected Year</label>
                <input type="year" value= "<?php echo $row['passing_year'];?>" class="input" placeholder=" Enter Passing/Expected Year" name="passing_year">
            </div> 


            <h4 class="section">Tranning Information</h4>
            <div class="inputField">
                <label>Sports Academy</label>
                <input type="text" value= "<?php echo $row['academy'];?>" class="input" placeholder=" Enter Academy Name" name="academy">
            </div>
            
            <div class="inputField">
                <label>Specialization</label>
                <input type="text" value= "<?php echo $row['specialization'];?>" class="input" placeholder=" Enter Specialization" name="specialization" required>
            </div> 

            <div class="inputField">
                <input type="submit" value="UPDATE" class="btn" name="update">
            </div>

            </div>
        </form>
        </div>

    </div>

    
</body>
</html>

<?php
include("database.php");

if(isset($_POST['update'])) {
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
    $institute = $_POST['institute'];
    $passing_year = $_POST['passing_year'];
    $academy = $_POST['academy'];
    $specialization = $_POST['specialization'];

    // Check for empty fields
    if(empty($first_name) && empty($last_name) || empty($email) || empty($phone_number)|| empty($nationality) || empty($dob) || empty($age) || empty($specialization)) {
        echo "<script>alert('Please fill all required fields')</script>";
    } else {
        // Construct SQL queries
        $query_basic = "UPDATE Player 
                        SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name', email = '$email', phone_number = '$phone_number', nationality = '$nationality', dob = '$dob', age = '$age' WHERE player_id = '$player_id'";
        $query_education = "UPDATE Player_Education 
                            SET degree = '$degree', institute = '$institute', passing_year = '$passing_year' WHERE player_id = '$player_id'";
        $query_training = "UPDATE Player_Training 
                           SET academy = '$academy', specialization = '$specialization' WHERE player_id = '$player_id'";



        // Execute SQL queries
        $result1 = mysqli_query($conn, $query_basic);
        
        // Check for query execution success
        if($result1) {
            // Update Player table successful, proceed with other updates
            $result2 = mysqli_query($conn, $query_education);
            $result3 = mysqli_query($conn, $query_training);

            // Check for query execution success
            if($result2 && $result3) {
                echo "<script>alert('Database updated successfully!');</script>";
                header('location:display.php');
            } else {
                echo "<script>alert('Update Failed!');</script>";
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Error Update Player table
            echo "<script>alert('Update Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?> 