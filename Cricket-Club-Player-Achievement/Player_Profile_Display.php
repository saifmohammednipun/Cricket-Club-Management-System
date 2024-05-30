<?php
include("database.php");

session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'player') {
    header('location:login.php');
    exit;
}

$query_player = "SELECT * FROM Player_Login NATURAL JOIN Player NATURAL JOIN Player_Education NATURAL JOIN Player_Training NATURAL JOIN Registration WHERE username = '$username'";
$result = mysqli_query($conn, $query_player);
$total = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Information List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            background-color: white;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

        .update {
            background-color: green;
            color: white;
            border: 0;
            outline: none;
            height: 30px;
            width: 60px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-btn {
            background: white;
            color: black;
            height: 35px;
            width: 100px;
            font-size: 18px;
            font-family: 'Times New Roman', Times, serif;
            margin-left: 90%;
            border: 1px solid black;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome Player, <?php echo htmlspecialchars($username); ?>!</h1>
    <a href="logout.php"><input type="button" value="Logout" class="logout-btn"></a>

    <?php if ($total > 0) { ?>
        <h2 align="center">PLAYER Profile</h2>
        <center>
        <table class="table1" border="1" cellspacing="7">
            <tr>
                <th>Player ID</th>
                <th>Registration ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Nationality</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>Degree</th>
                <th>Institute</th>
                <th>Passing Year</th>
                <th>Academy</th>
                <th>Specialization</th>
                <th>Operations</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) {
                echo
            "<tr>
                <td>".$row['player_id']."</td>
                <td>".$row['registration_id']."</td>
                <td>".$row['first_name']."</td>
                <td>".$row['middle_name']."</td>
                <td>".$row['last_name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['phone_number']."</td>
                <td>".$row['nationality']."</td>
                <td>".$row['dob']."</td>
                <td>".$row['age']."</td>
                <td>".$row['degree']."</td>
                <td>".$row['institution']."</td>
                <td>".$row['passing_year']."</td>
                <td>".$row['academy']."</td>
                <td>".$row['specialization']."</td>
                
                <td><a href='update.php?player_id=$row[player_id]'><input type ='submit' value= 'Update' class='update'></a> </td>
                
             
            </tr>";
             } ?>
        </table>
        </center>
    <?php } else {
        echo "<p>No records found</p>";
    } ?>
</body>
</html>




