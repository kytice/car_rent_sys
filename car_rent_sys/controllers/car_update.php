<?php
require __DIR__ . '/../repositories/car_repository.php';
require __DIR__ . '/../utils/validation.php';
require __DIR__ . '/../utils/functions.php'; 

$success = false;

if (isset($_POST['submit'])) {
    $carData = $_POST;
    
    $success = updateCar($pdo, $carData);
        if ($success) {
        header("Location: ../views/cars_list_all.php");
    } else {
        echo "<script>alert('Error updating car');</script>";
    }
}
?>