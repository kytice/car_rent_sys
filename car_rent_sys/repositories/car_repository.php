<?php
require __DIR__ . '/../config/db.php';

function fetchAllCarTypes($pdo) {
    $stmt = $pdo->query('SELECT * FROM Types');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchCarByRegNum($pdo, $regNum) {
    $stmt = $pdo->prepare('SELECT * FROM Cars WHERE RegNum = :regNum');
    $stmt->bindValue(':regNum', $regNum);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchCarDetailsByRegNum($pdo, $regNum) {
    $stmt = $pdo->prepare(
        'SELECT c.RegNum, c.Make, c.Model, c.Capacity, c.Trans, 
                c.Mileage, c.FuelType, t.TypeName, t.DailyRate
         FROM Cars c
         JOIN Types t ON c.TypeID = t.TypeID
         WHERE c.RegNum = :regNum');
    $stmt->bindValue(':regNum', $regNum);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchAllCars($pdo) {
    $stmt = $pdo->query(
        'SELECT c.CarID, c.RegNum, c.Make, c.Model, t.TypeName, t.DailyRate
         FROM Cars c
         JOIN Types t ON c.TypeID = t.TypeID
         ORDER BY c.CarID');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchCarsByRegNum($pdo, $regNum) {
    $stmt = $pdo->prepare(
        'SELECT c.CarID, c.RegNum, c.Make, c.Model, t.TypeName, t.DailyRate
         FROM Cars c
         JOIN Types t ON c.TypeID = t.TypeID
         WHERE c.RegNum LIKE :regNum');
    $stmt->bindValue(':regNum', "%$regNum%");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function regNumExist($pdo, $regNum) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM Cars WHERE RegNum = :regNum');
    $stmt->bindValue(':regNum', $regNum);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function addCar($pdo, $carData) {
    $stmt = $pdo->prepare(
        'INSERT INTO Cars (RegNum, TypeID, Make, Model, Capacity, Trans, Mileage, FuelType)
         VALUES (:regNum, :typeID, :make, :model, :capacity, :trans, :mileage, :fuelType)');
    $stmt->bindValue(':regNum', $carData['RegNum']);
    $stmt->bindValue(':typeID', $carData['TypeID']);
    $stmt->bindValue(':make', $carData['Make']);
    $stmt->bindValue(':model', $carData['Model']);
    $stmt->bindValue(':capacity', $carData['Capacity']);
    $stmt->bindValue(':trans', $carData['Trans']);
    $stmt->bindValue(':mileage', $carData['Mileage']);
    $stmt->bindValue(':fuelType', $carData['FuelType']);
    return $stmt->execute();
}

function updateCar($pdo, $carData) {
    $stmt = $pdo->prepare(
        'UPDATE Cars
         SET TypeID = :typeID, Make = :make, Model = :model, Capacity = :capacity, 
             Trans = :trans, Mileage = :mileage, FuelType = :fuelType
         WHERE RegNum = :regNum');
    $stmt->bindValue(':typeID', $carData['TypeID']);
    $stmt->bindValue(':make', $carData['Make']);
    $stmt->bindValue(':model', $carData['Model']);
    $stmt->bindValue(':capacity', $carData['Capacity']);
    $stmt->bindValue(':trans', $carData['Trans']);
    $stmt->bindValue(':mileage', $carData['Mileage']);
    $stmt->bindValue(':fuelType', $carData['FuelType']);
    $stmt->bindValue(':regNum', $carData['RegNum']);
    return $stmt->execute();
}

function fetchAvailableCars($pdo, $pickupDate, $estReturnDate, $carType) {
    $stmt = $pdo->prepare(
        'SELECT c.CarID, c.RegNum, c.Make, c.Model, t.DailyRate, c.Capacity, c.Trans
         FROM Cars c
         JOIN Types t ON c.TypeID = t.TypeID
         WHERE c.TypeID = :carType
         AND NOT EXISTS (
             SELECT 1
             FROM Reservations r
             WHERE c.CarID = r.CarID
             AND (:pickupDate BETWEEN r.PickupDate AND r.EstReturnDate
                 OR :estReturnDate BETWEEN r.PickupDate AND r.EstReturnDate
                 OR r.PickupDate BETWEEN :pickupDate AND :estReturnDate))');
    $stmt->bindValue(':carType', $carType);
    $stmt->bindValue(':pickupDate', $pickupDate);
    $stmt->bindValue(':estReturnDate', $estReturnDate);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>