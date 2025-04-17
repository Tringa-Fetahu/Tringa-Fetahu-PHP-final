<?php
include 'config.php';
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

$id = $_GET['id'];

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE users SET full_name = ?, email = ?, role = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['full_name'], $_POST['email'], $_POST['role'], $id
    ]);
    header("Location: dashboard.php?updated=1");
    exit;
}

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit User | F1 Tickets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="d-flex">
    <nav class="bg-white border-end" style="min-width: 220px; height: 100vh;">
        <div class="p-3">
            <h4 class="mb-4">🏎 F1 Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="index.php">🏠 Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">👤 Manage Users</a></li>
                <li class="nav-item"><a class="nav-link" href="bookings.php">📋 Manage Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="races.php">🏁 Manage Races</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid p-5">
        <div class="col-md-8 mx-auto bg-white p-4 rounded shadow">
            <h2 class="mb-4">✏️ Edit User Details</h2>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['full_name']) ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">✅ Update</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
