<?php
include 'config.php'; // Database connection

// Handle form submission for adding/editing races
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $round_number = $_POST['round_number'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $race_date = $_POST['race_date'];
    $track = $_POST['track'];
    
    if (isset($_POST['race_id'])) {
        // Update existing race
        $race_id = $_POST['race_id'];
        $query = "UPDATE races SET round_number='$round_number', country='$country', city='$city', race_date='$race_date', track='$track' WHERE id=$race_id";
    } else {
        // Insert new race
        $query = "INSERT INTO races (round_number, country, city, race_date, track) VALUES ('$round_number', '$country', '$city', '$race_date', '$track')";
    }
    
    if (mysqli_query($conn, $query)) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch race data if editing
$race = [
    'round_number' => '',
    'country' => '',
    'city' => '',
    'race_date' => '',
    'track' => ''
];
if (isset($_GET['id'])) {
    $race_id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM races WHERE id=$race_id");
    $race = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($_GET['id']) ? 'Edit Race' : 'Add Race' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center"><?= isset($_GET['id']) ? 'Edit Race' : 'Add Race' ?></h2>
        <form method="POST">
            <input type="hidden" name="race_id" value="<?= $_GET['id'] ?? '' ?>">
            <div class="mb-3">
                <label class="form-label">Round Number</label>
                <input type="number" class="form-control" name="round_number" value="<?= $race['round_number'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" class="form-control" name="country" value="<?= $race['country'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="city" value="<?= $race['city'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Race Date</label>
                <input type="date" class="form-control" name="race_date" value="<?= $race['race_date'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Track</label>
                <input type="text" class="form-control" name="track" value="<?= $race['track'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
