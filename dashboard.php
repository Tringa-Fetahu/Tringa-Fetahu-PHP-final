<?php
include_once('config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: signinForm.php");
    exit;
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Admin: fetch all users
if ($role === 'admin') {
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users_data = $stmt->fetchAll();
} else {
    // User: fetch their reservations
    $stmt = $pdo->prepare("
        SELECT r.city, r.country, r.race_date, res.seats_reserved, res.approved
        FROM reservations res
        INNER JOIN races r ON res.race_id = r.id
        WHERE res.email = ?
    ");
    $stmt->execute([$email]);
    $reservations = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | F1 Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark p-2 shadow">
    <a class="navbar-brand px-3" href="#">🏎️ F1 Dashboard — Welcome, <?= htmlspecialchars($username); ?></a>
    <div class="navbar-nav ms-auto me-3">
        <a class="btn btn-outline-light" href="logout.php">Sign Out</a>
    </div>
</header>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse pt-3">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="index.php">🏠 Home</a></li>

                <?php if ($role === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">👤 Manage Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="bookings.php">📋 Manage Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="races.php">🏁 Manage Races</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">📋 My Reservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservation.php">🎫 Book Tickets</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
            <h1 class="h2 mb-4">Dashboard</h1>

            <!-- Admin: Users Table -->
            <?php if ($role === 'admin'): ?>
                <h2>Registered Users</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users_data as $user): ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= htmlspecialchars($user['full_name']); ?></td>
                                    <td><?= htmlspecialchars($user['email']); ?></td>
                                    <td><a href="editUsers.php?id=<?= $user['id']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                                    <td><a href="deleteUsers.php?id=<?= $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <!-- User: Their Reservations -->
            <?php else: ?>
                <h2>My Reservations</h2>
                <?php if (empty($reservations)): ?>
                    <div class="alert alert-info">You haven't booked any tickets yet.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Date</th>
                                    <th>Seats</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservations as $res): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($res['city']); ?></td>
                                        <td><?= htmlspecialchars($res['country']); ?></td>
                                        <td><?= htmlspecialchars($res['race_date']); ?></td>
                                        <td><?= $res['seats_reserved']; ?></td>
                                        <td><?= $res['approved'] ? '✅ Approved' : '⏳ Pending'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
