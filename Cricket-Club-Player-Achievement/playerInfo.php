<?php
    include("database.php");
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
        <div class="title"> INSERT Player Info</div>
        
        <form action="#" method="POST">
        <div class="form">
            <div class="inputField">
                <label>Player ID</label>
                <input type="number" class="input" placeholder=" Enter Player ID" name="player_id" required>
            </div>
            
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
                <input type="Last Name" class="input" placeholder=" Enter Last Name" name="last_name" required>
            </div>  

            <div class="inputField">
                <label>Email</label>
                <input type="text" class="input" placeholder=" Enter Email " name="email" required>
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
                <input type="number" class="input" placeholder=" Enter Date of Birth" name="age" required>
            </div> 

            <div class="inputField">
                <input type="submit" value="INSERT" class="btn" name="update">
            </div>
            </div>
        </form>
        </div>

    </div>

    
</body>
</html>

<?php
    if(isset($_POST['update']))
    {
        $player_id = $_POST['player_id'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $nationality = $_POST['nationality'];
        $dob = $_POST['dob'];
        $age = $_POST['age'];

        if(empty($player_id) && empty($first_name) && empty($middle_name) && empty($last_name) && empty($email) && empty($phone_number) && empty($nationality) && empty($dob) && empty($age))
        {
            echo "<script> alert('Please fill the empty fields')</script>>";
            
        }
        else
        {
            $query = "INSERT INTO player 
                      VALUES('$player_id', '$first_name', '$middle_name', '$last_name', '$email', '$phone_number', '$nationality', '$dob', '$age')";
        }
        
        $result = mysqli_query($conn, $query);

        if($result)
        {
            echo "<script> alert('Inserted in database successfully!')</script>>";
        }
        else
        {
            echo "<script> alert('Insertion Failed!' . mysqli_error($conn))</script>>";
        }
    }
?>