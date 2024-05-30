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

// Retrieve match ID from URL parameter
$match_id = $_GET['match_id'];

// Fetch match details
$query_match = "SELECT * FROM Matches WHERE match_id = '$match_id'";
$result_match = mysqli_query($conn, $query_match);
$match = mysqli_fetch_assoc($result_match);

// Retrieve teams and venues for dropdowns
$query_teams = "SELECT team_id, team_name FROM Team";
$result_teams = mysqli_query($conn, $query_teams);

$query_venues = "SELECT venue_id, venue_name FROM Venue";
$result_venues = mysqli_query($conn, $query_venues);

// Handle form submission
if (isset($_POST['update'])) {
    // Retrieve form data
    $match_date = $_POST['match_date'];
    $home_team_id = $_POST['home_team_id'];
    $away_team_id = $_POST['away_team_id'];
    $result = $_POST['result'];
    $venue_id = $_POST['venue_id'];

    // Check for empty fields
    if (empty($match_date) || empty($home_team_id) || empty($away_team_id) || empty($result) || empty($venue_id)) {
        echo "<script>alert('Please fill all required fields');</script>";
    } else {
        // Construct SQL query
        $query_update = "UPDATE Matches 
                         SET match_date = '$match_date', home_team_id = '$home_team_id', away_team_id = '$away_team_id', result = '$result', venue_id = '$venue_id'
                         WHERE match_id = '$match_id'";
        // Execute SQL query
        $result_update = mysqli_query($conn, $query_update);

        // Check for query execution success
        if ($result_update) {
            echo "<script>alert('Match updated successfully!');</script>";
            header('location:matches.php');
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
    <title>Update Match</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">UPDATE MATCH DETAILS</div>

        <form action="#" method="POST">
            <div class="form">
                <h4 class="section">Match</h4>

                <div class="inputField">
                    <label>Match Date</label>
                    <input type="date" class="input" value="<?php echo $match['match_date']; ?>" placeholder="Enter Match Date" name="match_date" required>
                </div>  

                <div class="inputField">
                    <label>Home Team</label>
                    <select class="input" name="home_team_id" required>
                        <option value="">Select Home Team</option>
                        <?php while($team = mysqli_fetch_assoc($result_teams)) { ?>
                            <option value="<?php echo $team['team_id']; ?>" <?php if($team['team_id'] == $match['home_team_id']) echo 'selected'; ?>><?php echo $team['team_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>  

                <div class="inputField">
                    <label>Away Team</label>
                    <select class="input" name="away_team_id" required>
                        <option value="">Select Away Team</option>
                        <?php 
                        // Re-run query for teams
                        $result_teams = mysqli_query($conn, $query_teams);
                        while($team = mysqli_fetch_assoc($result_teams)) { ?>
                            <option value="<?php echo $team['team_id']; ?>" <?php if($team['team_id'] == $match['away_team_id']) echo 'selected'; ?>><?php echo $team['team_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>  

                <div class="inputField">
                    <label>Result</label>
                    <input type="text" class="input" value="<?php echo $match['result']; ?>" placeholder="Enter Result" name="result" required>
                </div>  

                <div class="inputField">
                    <label>Venue</label>
                    <select class="input" name="venue_id" required>
                        <option value="">Select Venue</option>
                        <?php while($venue = mysqli_fetch_assoc($result_venues)) { ?>
                            <option value="<?php echo $venue['venue_id']; ?>" <?php if($venue['venue_id'] == $match['venue_id']) echo 'selected'; ?>><?php echo $venue['venue_name']; ?></option>
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
