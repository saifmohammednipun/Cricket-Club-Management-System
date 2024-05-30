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
    $query_matches = "SELECT * From Scorer NATURAL JOIN Player Natural Join Matches NATURAL JOIN Venue;";
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
        <h1>Match Scorers</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Player ID</th>
                    <th>First Name</th>
                    <th>Runs</th>
                    <th>Wickets</th>
                    <th>Catches</th>
                    <th>Match Date</th>
                    <th>Venue Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Display each match
                    while($row = mysqli_fetch_assoc($result_matches)) {
                        echo "<tr>";
                        echo "<td>".$row['player_id']."</td>";
                        echo "<td>".$row['first_name']."</td>";
                        echo "<td>".$row['runs']."</td>";
                        echo "<td>".$row['wickets']."</td>";
                        echo "<td>".$row['catches']."</td>";
                        echo "<td>".$row['match_date']."</td>";
                        echo "<td>".$row['venue_name']."</td>";
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
