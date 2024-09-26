<?php 
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../controllers/reservation_details.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Reservation Details</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php include_once __DIR__ . '/../views/sidebar.html'; ?>
    <?php if ($resDetails): ?>
    <h2>Reservation Details</h2>
    <table class="info-table">
        <tr>
            <td>Reservation ID</td>
            <td><?php echo e($resDetails['ResID']); ?></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><?php echo e($resDetails['FName']); ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?php echo e($resDetails['SName']); ?></td>
        </tr>
        <tr>
            <td>Driver License</td>
            <td><?php echo e($resDetails['DriverLicense']); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo e($resDetails['Email']); ?></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><?php echo e($resDetails['Phone']); ?></td>
        </tr>
        <tr>
            <td>Reservation Date</td>
            <td><?php echo e($resDetails['ResDate']); ?></td>
        </tr>
        <tr>
            <td>Pickup Date</td>
            <td><?php echo e($resDetails['PickupDate']); ?></td>
        </tr>
        <tr>
            <td>Estimated Return Date</td>
            <td><?php echo e($resDetails['EstReturnDate']); ?></td>
        </tr>
        <tr>
            <td>Actual Return Date</td>
            <td><?php echo e($resDetails['ActReturnDate']); ?></td>
        </tr>
        <tr>
            <td>Cost</td>
            <td>€<?php echo e($resDetails['Cost']); ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><?php echo e($resDetails['Status']); ?></td>
        </tr>
        <tr>
            <td>Make</td>
            <td><?php echo e($resDetails['Make']); ?></td>
        </tr>
        <tr>
            <td>Model</td>
            <td><?php echo e($resDetails['Model']); ?></td>
        </tr>
        <tr>
            <td>Capacity</td>
            <td><?php echo e($resDetails['Capacity']); ?></td>
        </tr>
        <tr>
            <td>Transmission</td>
            <td><?php echo e($resDetails['Trans']); ?></td>
        </tr>
        <tr>
            <td>Mileage</td>
            <td><?php echo e($resDetails['Mileage']); ?></td>
        </tr>
        <tr>
            <td>Fuel Type</td>
            <td><?php echo e($resDetails['FuelType']); ?></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><?php echo e($resDetails['TypeName']); ?></td>
        </tr>
        <tr>
            <td>Daily Rate</td>
            <td>€<?php echo e($resDetails['DailyRate']); ?></td>
        </tr>
    </table>
    <?php endif; ?>
    <button class="back-btn" onclick="history.back()">Back</button>
</body>

</html>