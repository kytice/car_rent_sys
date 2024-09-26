<?php
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../repositories/reservation_repository.php';

$resid = $_GET['resid'];

$success = false;

$success = deleteReservation($pdo, $resid);

if ($success) {
        header("Location: ../public/index.php");
        exit();
    } else {
        echo "<script>alert('Error deleting reservation');</script>";
    }
?>