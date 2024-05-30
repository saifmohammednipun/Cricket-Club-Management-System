<?php
// Include database connection
include("database.php");

// Start session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit;
}

// Retrieve matches from the database
$query_matches = "SELECT m.match_id, m.match_date,m.result, v.venue_name, h.team_name AS HOME_TEAM, a.team_name AS AWAY_TEAM
FROM Matches m
JOIN Team h ON h.team_id = m.home_team_id
JOIN Team a ON a.team_id = m.away_team_id
JOIN Venue v ON v.venue_id = m.venue_id
ORDER BY m.match_id ASC;";
$result_matches = mysqli_query($conn, $query_matches);

// Check if there are matches
$total = mysqli_num_rows($result_matches);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches</title>
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
    </style>
</head>
<body>

<div class="navbar">
    <h1>Admin Panel</h1>
    <div>
        <a href="Insert.php">Registration</a>
        <a href="player_contracts.php">Contracts</a>
        <a href="matches.php">Matches</a>
        <a href="match_best_scorer.php">Match Scorer</a>
        <a href="achievement.php">Achievements</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="table-container">
    <?php
    if ($total != 0) {
        echo "<h2>Match Results</h2><br>";
        echo "<table border='1' cellspacing='7'>
            <tr>
                <th>Match Date</th>
                <th>Home Team</th>
                <th>Away Team</th>
                <th>Result</th>
                <th>Venue Name</th>
            </tr>";
        
        // Fetch and display all rows
        while($row = mysqli_fetch_assoc($result_matches)) {
            echo "<tr>
                <td>{$row['match_date']}</td>
                <td>{$row['HOME_TEAM']}</td>
                <td>{$row['AWAY_TEAM']}</td>
                <td>{$row['result']}</td>
                <td>{$row['venue_name']}</td>
            </tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No matches found</p>";
    }
    ?>
</div>

</body>
</html>
