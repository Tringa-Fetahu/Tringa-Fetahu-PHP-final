<?php
include 'config.php';
if ($_SESSION['role'] !== 'admin') exit;

$stmt = $pdo->query("SELECT res.id, res.full_name, res.email, res.seats_reserved, res.approved, r.city, r.country, r.race_date
FROM reservations res
JOIN races r ON res.race_id = r.id");
$reservations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Bookings</title>
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
                <li class="nav-item"><a class="nav-link active" href="bookings.php">📋 Manage Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="races.php">🏁 Manage Races</a></li>
            </ul>
        </nav>

        <!-- Main content -->
        <div class="flex-grow-1 p-4">
            <h2>Reservations</h2>
            <h4 class="mb-3">Movie Bookings</h4>

            <table class="table table-sm table-bordered table-striped w-100">
                <thead class="table-dark">
                    <tr>
                        <th>Race</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Seats</th>
                        <th>Approved</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2025-04-13</td>
                        <td>Tringa</td>
                        <td>ffetahu@gmail.com</td>
                        <td>3</td>
                        <td>0</td>
                    </tr>
                    <!-- Add more rows dynamically here if needed -->
                </tbody>
            </table>
        </div>
    </div>
</body>

	<script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>

