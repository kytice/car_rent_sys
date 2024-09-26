<?php
require __DIR__ . '/../config/db.php';

function fetchAllReservations($pdo) {
    $stmt = $pdo->query(
        'SELECT r.ResID, c.Make, c.Model, r.FName, r.SName, r.PickupDate, r.Status 
         FROM Reservations r 
         JOIN Cars c ON r.CarID = c.CarID 
         ORDER BY CASE 
                     WHEN r.Status = "Reserved" THEN 1 
                     WHEN r.Status = "Picked Up" THEN 2 
                     WHEN r.Status = "Dropped Off" THEN 3  
                 END');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchReservationsById($pdo, $resId) {
    $stmt = $pdo->prepare(
        'SELECT r.ResID, c.Make, c.Model, r.FName, r.SName, r.PickupDate, r.Status 
         FROM Reservations r 
         JOIN Cars c ON r.CarID = c.CarID 
         WHERE r.ResID LIKE :resId');
    $stmt->bindValue(':resId', "%$resId%");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchReservationDetailsById($pdo, $resId) {
    $stmt = $pdo->prepare(
        'SELECT r.ResID, r.CarID, r.FName, r.SName, r.DriverLicense, r.Email, r.Phone, r.ResDate, r.PickupDate, 
                r.EstReturnDate, r.ActReturnDate, r.Cost, r.Status,
                c.Make, c.Model, c.Capacity, c.Trans, c.Mileage, c.FuelType,
                t.TypeName, t.DailyRate 
         FROM Reservations r 
         JOIN Cars c ON r.CarID = c.CarID 
         JOIN Types t ON c.TypeID = t.TypeID 
         WHERE r.ResID = :resId');
    $stmt->bindValue(':resId', $resId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createReservation($pdo, $resData) {
    $stmt = $pdo->prepare(
        'INSERT INTO Reservations (CarID, FName, SName, Email, Phone, ResDate, PickupDate, 
                                   EstReturnDate, Cost, Status) 
         VALUES (:carId, :fName, :sName, :email, :phone, :resDate, :pickupDate, 
                 :estReturnDate, :cost, :status)');
    $stmt->bindValue(':carId', $resData['CarID']);
    $stmt->bindValue(':fName', $resData['FName']);
    $stmt->bindValue(':sName', $resData['SName']);
    $stmt->bindValue(':email', $resData['Email']);
    $stmt->bindValue(':phone', $resData['Phone']);
    $stmt->bindValue(':resDate', date('Y-m-d')); 
    $stmt->bindValue(':pickupDate', $resData['PickupDate']);
    $stmt->bindValue(':estReturnDate', $resData['EstReturnDate']);
    $stmt->bindValue(':cost', $resData['Cost']);
    $stmt->bindValue(':status', 'Reserved');
    return $stmt->execute();
}

function processRental($pdo, $resId, $driverLicense) {
    $stmt = $pdo->prepare(
        'UPDATE Reservations 
         SET DriverLicense = :driverLicense, Status = "Picked Up" 
         WHERE ResID = :resId');
    $stmt->bindValue(':driverLicense', $driverLicense);
    $stmt->bindValue(':resId', $resId);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function processReturn($pdo, $resId, $actReturnDate, $mileage, $additionalCost = 0) {
    $stmt = $pdo->prepare(
        'UPDATE Reservations 
         SET ActReturnDate = :actReturnDate, 
             Cost = Cost + :additionalCost, 
             Status = "Dropped Off" 
         WHERE ResID = :resId');
    $stmt->bindValue(':actReturnDate', $actReturnDate);
    $stmt->bindValue(':additionalCost', $additionalCost);
    $stmt->bindValue(':resId', $resId);
    $stmt->execute();

    $stmt = $pdo->prepare(
        'UPDATE Cars 
         SET Mileage = :mileage 
         WHERE CarID = (SELECT CarID FROM Reservations WHERE ResID = :resId)');
    $stmt->bindValue(':mileage', $mileage);
    $stmt->bindValue(':resId', $resId);
    return $stmt->execute();
}

function calculateTotalCost($pdo, $pickupDate, $returnDate, $carId) {
    $dailyRate = fetchDailyRate($pdo, $carId);
    $pickup = new DateTime($pickupDate);
    $return = new DateTime($returnDate);
    $duration = $pickup->diff($return)->days + 1;
    return $dailyRate * $duration;
}

function calculateAdditionalCost($pdo, $carId, $estReturnDate, $actReturnDate) {
    $dailyRate = fetchDailyRate($pdo, $carId);
    $estReturn = new DateTime($estReturnDate);
    $actReturn = new DateTime($actReturnDate);

    if ($actReturn > $estReturn) {
        $extraDays = $estReturn->diff($actReturn)->days;
        return $dailyRate * $extraDays;
    }
    return 0;
}

function fetchDailyRate($pdo, $carId) {
    $stmt = $pdo->prepare(
        'SELECT t.DailyRate 
         FROM Types t 
         JOIN Cars c ON t.TypeID = c.TypeID 
         WHERE c.CarID = :carId');
    $stmt->bindValue(':carId', $carId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['DailyRate'];
}

function deleteReservation($pdo, $resId) {
    $stmt = $pdo->prepare('DELETE FROM Reservations WHERE ResID = :resId');
    $stmt->bindValue(':resId', $resId);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}
?>