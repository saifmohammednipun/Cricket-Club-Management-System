<?php
    // Include database connection
    include("database.php");

    // Start session
    session_start();

    // Check if user is logged in
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
    Order BY m.match_id ASC;
    ";
    $result_matches = mysqli_query($conn, $query_matches);


    // Check if there are matches
    if(mysqli_num_rows($result_matches) > 0) {
        // Matches exist, display them
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h1>Matches</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Match ID</th>
                    <th>Date</th>
                    <th>Home Team</th>
                    <th>Away Team</th>
                    <th>Result</th>
                    <th>Venue</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Display each match
                    while($row = mysqli_fetch_assoc($result_matches)) {
                        echo "<tr>";
                        echo "<td>".$row['match_id']."</td>";
                        echo "<td>".$row['match_date']."</td>";
                        echo "<td>".$row["HOME_TEAM"]."</td>";
                        echo "<td>".$row["AWAY_TEAM"]."</td>";
                        echo "<td>".$row['result']."</td>";
                        echo "<td>".$row["venue_name"]."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    } else {
        // No matches found
        echo "<h3>No matches found.</h3>";
    }
?>
