<?php 
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../controllers/car_details.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Car Details</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php include_once __DIR__ . '/../views/sidebar.html'; ?>
    <?php if ($carDetails): ?>
    <h2>Car Details</h2>
    <table class="info-table">
        <tr>
            <td>Registration Number</td>
            <td><?php echo e($carDetails['RegNum']) ?></td>
        </tr>
        <tr>
            <td>Make</td>
            <td><?php echo e($carDetails['Make']) ?></td>
        </tr>
        <tr>
            <td>Model</td>
            <td><?php echo e($carDetails['Model']) ?></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><?php echo e($carDetails['TypeName']) ?></td>
        </tr>
        <tr>
            <td>Daily Rate</td>
            <td>€<?php echo e($carDetails['DailyRate']) ?></td>
        </tr>
        <tr>
            <td>Transmission</td>
            <td><?php echo e($carDetails['Trans']) ?></td>
        </tr>
        <tr>
            <td>Fuel Type</td>
            <td><?php echo e($carDetails['FuelType']) ?></td>
        </tr>
        <tr>
            <td>Mileage</td>
            <td><?php echo e($carDetails['Mileage']) ?></td>
        </tr>
    </table>
    <?php endif; ?>
    <button class="back-btn" onclick="history.back()">Back</button>
</body>

</html>