<?php
include 'config.php';


if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Handle race creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = $_POST['city'];
    $country = $_POST['country'];
    $race_date = $_POST['race_date'];
    $round_number = $_POST['round_number'];
    $track = $_POST['track'];
    $track_image = $_POST['track_image'];

    $sql = "INSERT INTO races (city, country, race_date, round_number, track, track_image)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$city, $country, $race_date, $round_number, $track, $track_image]);

    header("Location: races.php?success=1");
    exit;
}

// Fetch all races
$stmt = $pdo->query("SELECT * FROM races");
$races = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Races</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container-fluid mt-4">
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-white border-end p-3" style="min-width: 150px; height: 100vh;">
            <h4 class="mb-4">🏎 F1 Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="index.php">🏠 Home</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">👤 Manage Users</a></li>
                <li class="nav-item"><a class="nav-link" href="bookings.php">📋 Manage Bookings</a></li>
                <li class="nav-item"><a class="nav-link active" href="races.php">🏁 Manage Races</a></li>
            </ul>
        </nav>
<style>
    .d-flex{
        margin-left: -15px;
    }
</style>
        <!-- Main Content Area -->
        <div class="flex-grow-1 px-4">
            <h2 class="mb-4 mt-2">Race Management</h2>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Race added successfully!</div>
            <?php endif; ?>

            <!-- Add Race Form -->
            <form method="POST" class="mb-5">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="city" placeholder="City" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="country" placeholder="Country" required>
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="race_date" required>
                    </div>
                </div>
                <div class="row mt-2 g-2">
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="round_number" placeholder="Round #" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="track" placeholder="Track" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="track_image" placeholder="Track Image URL">
                    </div>
                </div>
                <button class="btn btn-success mt-3">Add Race</button>
            </form>

            <!-- Race Table -->
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>City</th>
                        <th>Country</th>
                        <th>Date</th>
                        <th>Round</th>
                        <th>Track</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($races as $race): ?>
                        <tr>
                            <td><?= $race['city'] ?></td>
                            <td><?= $race['country'] ?></td>
                            <td><?= $race['race_date'] ?></td>
                            <td><?= $race['round_number'] ?></td>
                            <td><?= $race['track'] ?></td>
                            <td>
                                <img src="<?= $race['track_image'] ?>" width="120" height="50" onerror="this.src='placeholder.jpg';">
                            </td>
                            <td>
                                <a href="editRace.php?id=<?= $race['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="deleteRace.php?id=<?= $race['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
