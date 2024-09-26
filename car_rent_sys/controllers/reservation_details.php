<?php
require_once __DIR__ . '/../repositories/reservation_repository.php';

if (isset($_GET['resid'])) {
    $resId = $_GET['resid'];
    $resDetails = fetchReservationDetailsById($pdo, $resId);
}
?>