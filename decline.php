<?php
include 'config.php';
session_start();
if ($_SESSION['role'] !== 'admin') exit;

$id = $_GET['id'];
$pdo->prepare("UPDATE reservations SET approved = 0 WHERE id = ?")->execute([$id]);
header("Location: bookings.php");