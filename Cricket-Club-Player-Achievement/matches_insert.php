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

// Handle form submission
if (isset($_POST['insert'])) {
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
        $query = "INSERT INTO Matches (match_date, home_team_id, away_team_id, result, venue_id) 
                  VALUES('$match_date', '$home_team_id', '$away_team_id', '$result', '$venue_id')";
        // Execute SQL query
        $result = mysqli_query($conn, $query);

        // Check for query execution success
        if ($result) {
            echo "<script>alert('Match inserted successfully!');</script>";
            header('location:matches.php');
        } else {
            echo "<script>alert('Insertion Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Retrieve teams and venues for dropdowns
$query_teams = "SELECT team_id, team_name FROM Team";
$result_teams = mysqli_query($conn, $query_teams);

$query_venues = "SELECT venue_id, venue_name FROM Venue";
$result_venues = mysqli_query($conn, $query_venues);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Match</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">MATCH DETAILS INSERTION</div>

      

        <form action="#" method="POST">
            <div class="form">
            <h4 class="section">Match</h4>

                <div class="inputField">
                    <label>Match Date</label>
                    <input type="date" class="input" placeholder="Enter Match Date" name="match_date" required>
                </div>  

                <div class="inputField">
                    <label>Home Team</label>
                    <select class="input" name="home_team_id" required>
                        <option value="">Select Home Team</option>
                        <?php while($row = mysqli_fetch_assoc($result_teams)) { ?>
                            <option value="<?php echo $row['team_id']; ?>"><?php echo $row['team_name']; ?></option>
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
                        while($row = mysqli_fetch_assoc($result_teams)) { ?>
                            <option value="<?php echo $row['team_id']; ?>"><?php echo $row['team_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>  

                <div class="inputField">
                    <label>Result</label>
                    <input type="text" class="input" placeholder="Enter Result" name="result" required>
                </div>  

                <div class="inputField">
                    <label>Venue</label>
                    <select class="input" name="venue_id" required>
                        <option value="">Select Venue</option>
                        <?php while($row = mysqli_fetch_assoc($result_venues)) { ?>
                            <option value="<?php echo $row['venue_id']; ?>"><?php echo $row['venue_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>  

                <div class="inputField">
                    <input type="submit" value="INSERT" class="btn" name="insert">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
