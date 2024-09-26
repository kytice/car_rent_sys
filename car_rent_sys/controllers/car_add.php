<?php
require __DIR__ . '/../repositories/car_repository.php';
require __DIR__ . '/../utils/validation.php';
require __DIR__ . '/../utils/functions.php'; 

$carData = [
    'RegNum' => $_POST['RegNum'] ?? '',
    'TypeID' => $_POST['TypeID'] ?? '',
    'Make' => $_POST['Make'] ?? '',
    'Model' => $_POST['Model'] ?? '',
    'Capacity' => $_POST['Capacity'] ?? '',
    'Trans' => $_POST['Trans'] ?? '',
    'Mileage' => $_POST['Mileage'] ?? '',
    'FuelType' => $_POST['FuelType'] ?? '',
];

$success = false;

if (isset($_POST['submit'])) {

    if (regNumExist($pdo, $carData['RegNum'])) {
        echo "<script>alert('Registration number already exists.');</script>";
    } elseif (!isValidRegNum($carData['RegNum'])) {
        echo "<script>alert('The registration number must be 8 or 9 characters long. It should start with the year (21-24), followed by a year half (1 or 2). It must include a 1 or 2-letter county code.');</script>";
    } else {
        $success = addCar($pdo, $carData);

        if ($success) {
            echo "<script>alert('New vehicle added successfully');</script>";
            
            $carData = [
                'RegNum' => '',
                'TypeID' => '',
                'Make' => '',
                'Model' => '',
                'Capacity' => '',
                'Trans' => '',
                'Mileage' => '',
                'FuelType' => ''
            ];
        } else {
            echo "<script>alert('Error adding new vehicle');</script>";
        }
    }
}

include __DIR__ . '/../forms/car_add_form.php';
?>