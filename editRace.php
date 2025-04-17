<?php
/* Creating a session based on a session identifier, passed via a GET or POST request.
   We include config.php for connection with database.
   This file fetches race data from database and shows them in a form to allow admin to edit. */

include_once('config.php');

if (empty($_SESSION['username'])) {
    header("Location: signinForm.php");
}

if ($_SESSION['is_admin'] != true) {
    header("Location: dashboard.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM races WHERE id=:id";
$selectRace = $con->prepare($sql);
$selectRace->bindParam(':id', $id);
$selectRace->execute();

$race_data = $selectRace->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Race</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
        <?php echo "Welcome to dashboard " . $_SESSION['username']; ?>
    </a>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="logout.php">Sign out</a>
        </div>
    </div>
</header>
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
        
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Race Details</h1>
            </div>

            <form action="editRaceLogic.php" method="post">
                <div class="form-floating mb-3">
                    <input readonly type="text" class="form-control" name="id" value="<?php echo $race_data['id']; ?>">
                    <label>ID</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="race_name" value="<?php echo $race_data['race_name']; ?>">
                    <label>Race Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="race_location" value="<?php echo $race_data['race_location']; ?>">
                    <label>Race Location</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="race_date" value="<?php echo $race_data['race_date']; ?>">
                    <label>Race Date</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="description" value="<?php echo $race_data['description']; ?>">
                    <label>Description</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
            </form>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
