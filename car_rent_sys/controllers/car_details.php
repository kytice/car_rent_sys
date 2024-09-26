<?php
require_once __DIR__ . '/../repositories/car_repository.php';

if (isset($_GET['regnum'])) {
    $regNum = $_GET['regnum'];
    $carDetails = fetchCarDetailsByRegNum($pdo, $regNum);
}
?>