<?php
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../utils/validation.php';
require_once __DIR__ . '/../repositories/reservation_repository.php';

$resId = $_GET['resid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $driverLicense = strtoupper($_POST['driverLicense']);
    $error = '';

        if (isValidDriverLicense($driverLicense)) {
            $success = processRental($pdo, $resId, $driverLicense);

            if ($success) {
                header("Location: ../public/index.php");
            } else {
                $error = "Failed to process the reservation. Please try again.";
            }
        } else {
            $error = "Invalid driver's license format. Please enter letters and numbers (6 to 20).";
        }
    }

include __DIR__ . '/../forms/process_rental_form.php';