<?php 
require __DIR__ . '/../repositories/car_repository.php';
require __DIR__ . '/../repositories/reservation_repository.php';

$pickupDate = date('Y-m-d');
$estReturnDate = date('Y-m-d', strtotime('+2 days'));
$carTypes = fetchAllCarTypes($pdo);

if (isset($_POST['carType'], $_POST['pickupDate'], $_POST['estReturnDate'])) {
    $carType = $_POST['carType'];
    $pickupDate = $_POST['pickupDate'];
    $estReturnDate = $_POST['estReturnDate'];

    if (strtotime($pickupDate) < strtotime('today')) {
        $pickupDate = date('Y-m-d');
    }

    if (strtotime($estReturnDate) < strtotime($pickupDate)) {
        $estReturnDate = date('Y-m-d', strtotime($pickupDate . ' +1 day'));
    }

    $availableCars = fetchAvailableCars($pdo, $pickupDate, $estReturnDate, $carType);
}
?>