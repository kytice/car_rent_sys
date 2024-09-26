<?php
require_once __DIR__ . '/../utils/functions.php'; 
require_once __DIR__ . '/../repositories/reservation_repository.php';

$resData = [
    'CarID' => $_POST['carId'] ?? '',
    'FName' => ucwords(strtolower($_POST['fName'] ?? '')),
    'SName' => ucwords(strtolower($_POST['sName'] ?? '')),
    'Email' => strtolower($_POST['email'] ?? ''),
    'Phone' => $_POST['phone'] ?? '',
    'PickupDate' => $_POST['pickupDate'] ?? '',
    'EstReturnDate' => $_POST['estReturnDate'] ?? '',
    'Cost' => $_POST['cost'] ?? ''
];

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = createReservation($pdo, $resData);

    if ($success) {
        header("Location: ../public/index.php");
        exit();
    } else {
        echo "<script>alert('Error creating reservation');</script>";
    }
}

include __DIR__ . '/../forms/reservation_completion_form.php';
?>