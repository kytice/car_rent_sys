<?php
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../repositories/reservation_repository.php';

$resId = $_GET['resid'] ?? '';
$actReturnDate = date('Y-m-d');
$mileage = $_POST['mileage'] ?? '';
$additionalCost = 0;
$priceMsg = '';
$error = '';

$resDetails = fetchReservationDetailsById($pdo, $resId);

$initialMileage = $resDetails['Mileage'];

$success = false;

if ($actReturnDate > $resDetails['EstReturnDate']) {
    $additionalCost = calculateAdditionalCost($pdo, $resDetails['CarID'], $resDetails['EstReturnDate'], $actReturnDate);
    $priceMsg = "Return date exceeded. Additional cost: €$additionalCost. Total cost will be updated.";
} else {
    $priceMsg = "Return on time. No additional cost.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($mileage < $initialMileage) {
        $error = "The mileage cannot be less than the initial mileage of $initialMileage.";
    } else {
        $success = processReturn($pdo, $resId, $actReturnDate, $mileage, $additionalCost);

        if ($success) {
            header("Location: ../public/index.php");
        } else {
            $error = "Failed to process the return.";
        }
    }
}

include __DIR__ . '/../forms/process_return_form.php';