<?php
include 'config.php'; // Connect to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $race_id = $_POST['race_id'];
    $full_name = $_POST['name']; // From form input
    $email = $_POST['email'];
    $seats_reserved = $_POST['seats'];

    $sql = "INSERT INTO reservations (race_id, full_name, email, seats_reserved) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$race_id, $full_name, $email, $seats_reserved]);

    header("Location: index.php?reserved=1");
    exit();
}
?>
