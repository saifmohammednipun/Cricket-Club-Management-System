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
    $player_id = $_POST['player_id'];
    $match_id = $_POST['match_id'];
    $runs = $_POST['runs'];
    $wickets = $_POST['wickets'];
    $catches = $_POST['catches'];

    // Check for empty fields
    if (empty($player_id) || empty($match_id) || empty($runs) || empty($wickets) || empty($catches)) {
        echo "<script>alert('Please fill all required fields');</script>";
    } else {
        // Construct SQL query
        $query = "INSERT INTO Scorer (player_id, match_id, runs, wickets, catches) 
                  VALUES('$player_id', '$match_id', '$runs', '$wickets', '$catches')";
        // Execute SQL query
        $result = mysqli_query($conn, $query);

        // Check for query execution success
        if ($result) {
            echo "<script>alert('Match scorer inserted successfully!');</script>";
            header('location:match_scorer.php');
        } else {
            echo "<script>alert('Insertion Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Retrieve players and matches for dropdowns
$query_players = "SELECT player_id, CONCAT(first_name, ' ', last_name) AS player_name FROM Player";
$result_players = mysqli_query($conn, $query_players);

$query_matches = "SELECT match_id, match_date FROM Matches";
$result_matches = mysqli_query($conn, $query_matches);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Match Scorer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">MATCH SCORER INSERTION </div>
        <form action="#" method="POST">
            <div class="form">
            <h4 class="section">Matches Scorer Details</h4>
                <div class="inputField">
                    <label>Player</label>
                    <select class="input" name="player_id" required>
                        <option value="">Select Player</option>
                        <?php while($row = mysqli_fetch_assoc($result_players)) { ?>
                            <option value="<?php echo $row['player_id']; ?>"><?php echo $row['player_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>  

                <div class="inputField">
                    <label>Match Date</label>
                    <select class="input" name="match_id" required>
                        <option value="">Select Match</option>
                        <?php while($row = mysqli_fetch_assoc($result_matches)) { ?>
                            <option value="<?php echo $row['match_id']; ?>"><?php echo $row['match_date']; ?></option>
                        <?php } ?>
                    </select>
                </div>  

                <div class="inputField">
                    <label>Runs</label>
                    <input type="number" class="input" placeholder="Enter Runs" name="runs" required>
                </div>  

                <div class="inputField">
                    <label>Wickets</label>
                    <input type="number" class="input" placeholder="Enter Wickets" name="wickets" required>
                </div>  

                <div class="inputField">
                    <label>Catches</label>
                    <input type="number" class="input" placeholder="Enter Catches" name="catches" required>
                </div>  

                <div class="inputField">
                    <input type="submit" value="INSERT" class="btn" name="insert">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

