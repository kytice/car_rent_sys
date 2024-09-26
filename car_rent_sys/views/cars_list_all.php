<?php
require __DIR__ . '/../utils/functions.php';
require __DIR__ . '/../repositories/car_repository.php';

$regNum = $_GET['regnum'] ?? '';
$cars = !empty($regNum) ? searchCarsByRegNum($pdo, $regNum) : fetchAllCars($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Cars</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../views/sidebar.html'; ?>

    <div class="search-container">
        <div class="search-form">
            <form method="GET" action="">
                <input type="text" id="searchRegNum" name="regnum" placeholder="222D0000"
                    value="<?php echo e($regNum) ?>">
                <input type="submit" value="Search">
            </form>
        </div>
        <button class="btn" onclick="window.location.href='../controllers/car_add.php';">Add New Car</button>
    </div>

    <table>
        <tr>
            <th>RegNum</th>
            <th>Make</th>
            <th>Model</th>
            <th>Type</th>
            <th>Daily Rate</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($cars as $car): ?>
        <tr>
            <td><?php echo e($car['RegNum']) ?></td>
            <td><?php echo e($car['Make']) ?></td>
            <td><?php echo e($car['Model']) ?></td>
            <td><?php echo e($car['TypeName']) ?></td>
            <td><?php echo e($car['DailyRate']) ?></td>
            <td>
                <a href="../views/car_details_view.php?regnum=<?php echo e($car['RegNum']) ?>">View</a> |
                <a href="../forms/car_update_form.php?regnum=<?php echo e($car['RegNum']) ?>">Update</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>