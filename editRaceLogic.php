<?php
include_once('config.php');

if (isset($_POST['id']) && isset($_POST['race_name']) && isset($_POST['race_location']) && isset($_POST['race_date']) && isset($_POST['description'])) {
    
    $id = $_POST['id'];
    $race_name = $_POST['race_name'];
    $race_location = $_POST['race_location'];
    $race_date = $_POST['race_date'];
    $description = $_POST['description'];

    $sql = "UPDATE races SET race_name = :race_name, race_location = :race_location, race_date = :race_date, description = :description WHERE id = :id";
    $stmt = $con->prepare($sql);

    $stmt->bindParam(':race_name', $race_name);
    $stmt->bindParam(':race_location', $race_location);
    $stmt->bindParam(':race_date', $race_date);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=Race updated successfully");
    } else {
        echo "Something went wrong. Please try again.";
    }
} else {
    echo "Invalid input data.";
}
?>
