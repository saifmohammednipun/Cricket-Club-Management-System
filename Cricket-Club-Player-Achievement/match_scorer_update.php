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

// Retrieve scorer information based on scorer_id passed via GET method
if (isset($_GET['scorer_id'])) {
    $scorer_id = $_GET['scorer_id'];

    $query_scorer = "SELECT * FROM Scorer 
                     NATURAL JOIN Player 
                     NATURAL JOIN Matches 
                     NATURAL JOIN Venue 
                     NATURAL JOIN Contracts 
                     NATURAL JOIN Team 
                     WHERE scorer_id = '$scorer_id'";
    $result_scorer = mysqli_query($conn, $query_scorer);
    $row = mysqli_fetch_assoc($result_scorer);
} else {
    echo "<script>alert('No scorer selected!'); window.location='match_best_scorer.php';</script>";
}

// Handle form submission to update scorer details
if(isset($_POST['update'])) {
    // Retrieve form data
    $runs = $_POST['runs'];
    $wickets = $_POST['wickets'];
    $catches = $_POST['catches'];
    $match_date = $_POST['match_date'];
    $venue_name = $_POST['venue_name'];

    // Validate form data
    if(empty($runs) || empty($wickets) || empty($catches) || empty($match_date) || empty($venue_name)) {
        echo "<script>alert('Please fill all required fields');</script>";
    } else {
        // Construct SQL query to update scorer details
        $query_update = "UPDATE Scorer 
                         SET runs = '$runs', wickets = '$wickets', catches = '$catches' 
                         WHERE scorer_id = '$scorer_id'";

        $result_update = mysqli_query($conn, $query_update);

        // Check for query execution success
        if($result_update) {
            echo "<script>alert('Scorer details updated successfully!'); window.location='match_best_scorer.php';</script>";
        } else {
            echo "<script>alert('Update Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Match Scorer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">UPDATE MATCH SCORER DETAILS</div>

        <form action="#" method="POST">
            <div class="form">
                <h4 class="section">Scorer Details</h4>


                <div class="inputField">
                    <label>First Name</label>
                    <select class="input" name="player_id" required>
                        <option value="">Select Player</option>
                        <?php 
                        $query_players = "SELECT * FROM Player";
                        $result_players = mysqli_query($conn, $query_players);
                        while($player = mysqli_fetch_assoc($result_players)) { ?>
                            <option value="<?php echo $player['player_id']; ?>" <?php if($player['player_id'] == $row['player_id']) echo 'selected'; ?>><?php echo $player['first_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="inputField">
                    <label>Team Name</label>
                    <select class="input" name="team_id" required>
                        <option value="">Select Team</option>
                        <?php 
                        $query_teams = "SELECT * FROM Team";
                        $result_teams = mysqli_query($conn, $query_teams);
                        while($team = mysqli_fetch_assoc($result_teams)) { ?>
                            <option value="<?php echo $team['team_id']; ?>" <?php if($team['team_id'] == $row['team_id']) echo 'selected'; ?>><?php echo $team['team_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="inputField">
                    <label>Runs</label>
                    <input type="number" class="input" value="<?php echo $row['runs']; ?>" name="runs" required>
                </div>  

                <div class="inputField">
                    <label>Wickets</label>
                    <input type="number" class="input" value="<?php echo $row['wickets']; ?>" name="wickets" required>
                </div>  

                <div class="inputField">
                    <label>Catches</label>
                    <input type="number" class="input" value="<?php echo $row['catches']; ?>" name="catches" required>
                </div>  

                <div class="inputField">
                    <label>Match Date</label>
                    <input type="date" class="input" value="<?php echo $row['match_date']; ?>" name="match_date" required>
                </div>  

                <div class="inputField">
                    <label>Venue Name</label>
                    <select class="input" name="venue_name" required>
                        <option value="">Select Venue</option>
                        <?php 
                        $query_venues = "SELECT * FROM Venue";
                        $result_venues = mysqli_query($conn, $query_venues);
                        while($venue = mysqli_fetch_assoc($result_venues)) { ?>
                            <option value="<?php echo $venue['venue_name']; ?>" <?php if($venue['venue_name'] == $row['venue_name']) echo 'selected'; ?>><?php echo $venue['venue_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="inputField">
                    <input type="submit" value="UPDATE" class="btn" name="update">
                </div>
            </div>
        </form>
    </div>
</body>
</html>