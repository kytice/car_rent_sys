<?php
require __DIR__ . '/../utils/functions.php';
require __DIR__ . '/../repositories/reservation_repository.php';

$resid = $_GET['resid'] ?? '';
$reservations = !empty($resid) ? searchReservationsById($pdo, trim($resid)) : fetchAllReservations($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Reservations</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../views/sidebar.html'; ?>

    <div class="search-container">
        <div class="search-form">
            <form method="GET" action="">
                <input type="text" id="searchResId" name="resid" placeholder="1000" value="<?php echo e($resid) ?>">
                <input type="submit" value="Search">
            </form>
        </div>
        <button class="btn" onclick="window.location.href='../forms/reservation_dates_form.php';">Create
            Reservation</button>
    </div>

    <table>
        <tr>
            <th>Res ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Pickup Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($reservations as $reservation): ?>
        <tr>
            <td><?php echo e($reservation['ResID']) ?></td>
            <td><?php echo e($reservation['Make']) ?></td>
            <td><?php echo e($reservation['Model']) ?></td>
            <td><?php echo e($reservation['FName']) ?></td>
            <td><?php echo e($reservation['SName']) ?></td>
            <td><?php echo e($reservation['PickupDate']) ?></td>
            <td><?php echo e($reservation['Status']) ?></td>
            <td>
                <a href="../views/reservation_details_view.php?resid=<?php echo e($reservation['ResID']) ?>">View</a>
                <?php if ($reservation['Status'] === 'Reserved'): ?>
                | <a href="../controllers/reservation_delete.php?resid=<?php echo e($reservation['ResID']) ?>"
                    onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</a>
                | <a href="../controllers/process_rental.php?resid=<?php echo e($reservation['ResID']) ?>">Process</a>
                <?php elseif ($reservation['Status'] === 'Picked Up'): ?>
                | <a href="../controllers/process_return.php?resid=<?php echo e($reservation['ResID']); ?>">Return</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>