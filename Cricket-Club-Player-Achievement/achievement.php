<?php
// Include database connection
include("database.php");

// Start session
session_start();

// Check if user is logged in
if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit();
}

// Retrieve awards from the database
$query_awards = "SELECT * FROM Player NATURAL JOIN Awards NATURAL JOIN Matches NATURAL JOIN Venue NATURAL JOIN Contracts NATURAL JOIN Team ";
$result_awards = mysqli_query($conn, $query_awards);

// Check if there are awards
$total = mysqli_num_rows($result_awards);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievements</title>
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

        .update{
            background-color: green;
            color: white;
            border: 0;
            outline: none;
            height: 25px;
            width: 60px;
            font-weight: bold;
            cursor: pointer;
        }

        .delete{
            background-color: red;
            color: white;
            border: 0;
            outline: none;
            height: 25px;
            width: 60px;
            font-weight: bold;
            cursor: pointer;
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

<!-- <div class="navbar">
    <h1>Admin Panel</h1>
    <div>
      <a href="Insert.php">Registration</a>
        <a href="player_contracts.php">Contracts</a>
        <a href="matches.php">Matches</a>
        <a href="match_best_scorer.php">Match Scorer</a>
        <a href="achievement.php">Achievements</a>
        <a href="logout.php">Logout</a>
    </div>
</div> -->

<div class="navbar">
    <h1>Admin Panel</h1>
    <div justify-content-end>
    <div class="dropdown">
        <button class="dropbtn">Registration</button>
        <div class="dropdown-content">
            <a href="Insert.php">Player</a>
            <a href="#">Coach</a>
            <a href="#">Medical Staff</a>
            
        </div>
    </div> 
    <div class="dropdown">
        <button class="dropbtn">Contracts</button>
        <div class="dropdown-content">
            <a href="player_contracts.php">Player</a>
            <a href="#">Coach</a>
            <a href="#">Medical Staff</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Matches</button>
        <div class="dropdown-content">
           <a href="matches_admin.php">Fixtures & Results</a>
            <a href="matches_insert.php">Insert Match Details</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Match Scorer</button>
        <div class="dropdown-content">
            <a href="match_best_scorer.php">Scorers</a>
            <a href="match_scorer_insert.php">Insert Scorer</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Achievements</button>
        <div class="dropdown-content">
            <a href="achievement.php">Awards</a>
            <a href="award_insert.php">Insert Award Details</a>
        </div>
    </div>

    <a class="logout"href="logout.php">Logout</a>

    </div>
</div>

<div class="table-container">
    <?php
    if ($total != 0) {
        echo "<h2>Achievements</h2><br>";
        echo "<table border='1' cellspacing='7'>
            <tr>
                <th>First Name</th>
                <th>Award Name</th>
                <th>Award Category</th>
                <th>Description</th>
                <th>Match Date</th>
                <th>Team Name</th>
                <th>Venue Name</th>
                <th>Operations</th>

            </tr>";
        
        // Fetch and display all rows
        while($row = mysqli_fetch_assoc($result_awards)) {
            echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['award_name']}</td>
                <td>{$row['award_category']}</td>
                <td>{$row['description']}</td>
                <td>{$row['match_date']}</td>
                <td>{$row['team_name']}</td>
                <td>{$row['venue_name']}</td>
                <td>
                <a href='award_update.php?award_id=$row[award_id]'><input type ='submit' value= 'Update' class='update'></a>
                <a href='match_scorer_delete.php?scorer_id=$row[scorer_id]'><input type ='submit' value= 'Delete' class='delete'></a>
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
