<?php
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../repositories/reservation_repository.php';

$carId = $_GET['carId'];
$pickupDate = $_GET['pickupDate'];
$estReturnDate = $_GET['estReturnDate'];

$cost = calculateTotalCost($pdo, $pickupDate, $estReturnDate, $carId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Create Reservation</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php require __DIR__ . '/../views/sidebar.html'; ?>

    <h2>Complete Your Reservation</h2>

    <div class="form">
        <h3>Total Cost for the chosen car is €<?php echo e($cost); ?></h3>
    </div>

    <form class="form" action="/car_rent_sys/controllers/reservation_create.php" method="post">
        <input type="hidden" name="carId" value="<?php echo e($carId); ?>">
        <input type="hidden" name="pickupDate" value="<?php echo e($pickupDate); ?>">
        <input type="hidden" name="estReturnDate" value="<?php echo e($estReturnDate); ?>">
        <input type="hidden" name="cost" value="<?php echo e($cost); ?>">

        <div>
            <label for="fName">First Name:</label>
            <input type="text" id="fName" name="fName" required pattern="[A-Za-z\']{1,25}">
        </div>
        <div>
            <label for="sName">Surname:</label>
            <input type="text" id="sName" name="sName" required pattern="[A-Za-z\']{1,35}"
                title="Please enter a valid surname">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required pattern="[0-9\-\+]{5,25}">
        </div>

        <input type="submit" value="Submit">
    </form>
    <button class="back-btn" onclick="history.back()">Back</button>
</body>

</html>