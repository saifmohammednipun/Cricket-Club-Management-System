<?php
include("database.php");

session_start();

$username = $_SESSION['username'];

if (!$username) {
    header('location:login.php');
    exit();
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
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: darkblue;
            padding: 10px 20px;
            overflow: hidden;
        }

        .navbar h1 {
            color: white;
            margin: 0;
        }

        .navbar a {
            text-decoration: none;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
        }

        .navbar a:hover {
            background-color: blue;
        }

        .table-container {
            margin: 30px;
            margin-top: 70px;
            text-align: center;
        }

        h2 {
            color: white;
        }

        table {
            background-color: white;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th {
            background-color: darkblue;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
        }

        .update {
            background-color: green;
            color: white;
            border: 0;
            outline: none;
            height: 25px;
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

        /* Style the navbar */

        .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: blue;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: darkblue;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: rgb(130,106,251);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: blue;
        }

        .logout {
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>Player Profile</h1>
    
    <div justify-content-end>
    
    <a href="display_contracts.php">Contracts</a>
    <a href="career.php">Career</a>
    <a href="award.php">Achievements</a>
    <a class="logout" href="logout.php">Logout</a>
    </div>
</div>

<div class="table-container">
    <!-- <h1>Welcome Player, <?php echo htmlspecialchars($username); ?>!</h1> -->
    
    <?php if ($total > 0) { ?>
        <h2>PLAYER Profile</h2>
        <br>
        <table border="1" cellspacing="7" >
            <tr>
                <!-- <th>Player ID</th> -->
                <!-- <th>Registration ID</th> -->
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
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <!-- <td><?php echo $row['player_id']; ?></td> -->
                    <!-- <td><?php echo $row['registration_id']; ?></td> -->
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['middle_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['nationality']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['degree']; ?></td>
                    <td><?php echo $row['institution']; ?></td>
                    <td><?php echo $row['passing_year']; ?></td>
                    <td><?php echo $row['academy']; ?></td>
                    <td><?php echo $row['specialization']; ?></td>
                    <td><a href='update.php?player_id=<?php echo $row['player_id']; ?>'><input type='button' value='Update' class='update'></a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else {
        echo "<p>No records found</p>";
    } ?>
</div>

</body>
</html>
