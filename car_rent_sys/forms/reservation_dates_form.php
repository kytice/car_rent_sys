<?php
require_once __DIR__ . '/../controllers/reservation_cars_for_dates.php';
require_once __DIR__ . '/../utils/functions.php'; 
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

    <form class="dates-form" action="" method="post">
        <div class="dates-group">
            <label for="pickupDate">Pick-up Date:</label>
            <input type="date" id="pickupDate" name="pickupDate" value="<?php echo e($pickupDate); ?>">
        </div>
        <div class="dates-group">
            <label for="estReturnDate">Return Date:</label>
            <input type="date" id="estReturnDate" name="estReturnDate" value="<?php echo e($estReturnDate); ?>">
        </div>
        <div class="dates-group">
            <label for="carType">Car Type:</label>
            <select id="carType" name="carType" required>
                <?php foreach ($carTypes as $carType): ?>
                <option value="<?php echo e($carType['TypeID']); ?>"
                    <?php echo ($_POST['carType'] ?? '') == $carType['TypeID'] ? 'selected' : ''; ?>>
                    <?php echo e($carType['TypeName']); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="dates-group">
            <br>
            <button type="submit">Search</button>
        </div>
    </form>

    <?php if (isset($availableCars)): ?>
    <?php require __DIR__ . '/../views/cars_list_available.php'; ?>
    <?php endif; ?>
</body>

</html>