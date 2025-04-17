<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signinForm.php");
    exit;
}

// Get all races
$stmt = $pdo->query("SELECT id, city, country, race_date FROM races");
$races = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $race_id = $_POST['race_id'];
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $seats = $_POST['seats'];

    $sql = "INSERT INTO reservations (race_id, full_name, email, seats_reserved, approved) 
            VALUES (?, ?, ?, ?, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$race_id, $full_name, $email, $seats]);

    header("Location: reservation.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserve Race Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Book Your F1 Race Tickets</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Reservation successful! Awaiting approval.</div>
    <?php endif; ?>

    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="race_id" class="form-label">Select Race</label>
            <select class="form-control" name="race_id" required>
                <?php foreach ($races as $race): ?>
                    <option value="<?= $race['id'] ?>">
                        <?= $race['city'] ?>, <?= $race['country'] ?> (<?= $race['race_date'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Seats</label>
            <input type="number" name="seats" class="form-control" required>
        </div>
        <button class="btn btn-primary">Submit Reservation</button>
    </form>
</body>
</html>
