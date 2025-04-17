
<?php

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


	<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Drivers</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Teams</a></li>
          <?php if (isset($_SESSION['user_id'])): ?>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="dashboard.php" class="btn btn-outline-light me-2">Admin Panel</a>
    <?php else: ?>
        <a href="user_profile.php" class="btn btn-outline-light me-2">My Profile</a>
    <?php endif; ?>
<?php endif; ?>

          <?php

          if (!empty($_SESSION['user_id'])) {

          ?>
          
          <li><a href="dashboard.php" class="nav-link px-2 text-white">Profile</a></li>
          
          <?php 

            }

          ?>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>


        <?php
      if(empty($_SESSION['username'])){
    ?>
        <div class="col-md-3 text-end">
          <button type="button" class="btn btn-outline-primary me-2" onclick="window.location.href='signinForm.php';">Login</button>
          <button type="button" class="btn btn-primary" onclick="window.location.href='signupForm.php';">Sign-up</button>
        </div>
    <?php
      }else{
    ?>
      <div class="col-md-3 text-end">
        <button type="button" class="btn btn-outline-primary me-2" onclick="window.location.href='logout.php';">Log Out</button>
      </div>
    <?php
      }
    ?>
      </div>
    </div>
   
  </header>
