<?php
// Include database connection
include("database.php");

// Start session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

$username = $_SESSION['username'];


// Retrieve scorers from the database
$query_scorers = "SELECT * FROM Player NATURAL JOIN Player_Login  NATURAL JOIN Scorer NATURAL JOIN Matches NATURAL JOIN Venue NATURAL JOIN Contracts NATURAL JOIN TEAM where Player_Login.username = '$username'";
$result_scorers = mysqli_query($conn, $query_scorers);

// Check if there are scorers
$total = mysqli_num_rows($result_scorers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Scorers</title>
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
            color: white;
            border: 0;
            outline: none;
            height: 25px;
            width: 60px;
            font-weight: bold;
            cursor: pointer;
            background-color: green;
            
        }


              /* Style the navbar */

/* Style the dropdown button */
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

/* Dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: blue;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: darkblue;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: rgb(130,106,251);
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: blue;
}

/* Align logout button with the other buttons  */
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
    <?php
    if ($total != 0) {
        echo "<h2>Match Scorers</h2><br>";
        echo "<table border='1' cellspacing='7'>
            <tr>
                <th>First Name</th>
                <th>Team Name</th>
                <th>Runs</th>
                <th>Wickets</th>
                <th>Catches</th>
                <th>Match Date</th>
                <th>Venue Name</th>
                

            </tr>";
        
        // Fetch and display all rows
        while($row = mysqli_fetch_assoc($result_scorers)) {
            echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['team_name']}</td>
                <td>{$row['runs']}</td>
                <td>{$row['wickets']}</td>
                <td>{$row['catches']}</td>
                <td>{$row['match_date']}</td>
                <td>{$row['venue_name']}</td>

            </tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No records found</p>";
    }
    ?>
</div>

</body>
</html>
