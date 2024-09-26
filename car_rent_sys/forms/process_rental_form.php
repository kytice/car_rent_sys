<?php 
require_once __DIR__ . '/../utils/functions.php';

$resId = $_GET['resid']; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Process Rental</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../views/sidebar.html'; ?>

    <h2>Process Rental</h2>
    <form class="form" action="../controllers/process_rental.php?resid=<?php echo e($resId); ?>" method="post">
        <div>
            <label for="driverLicense">Driver's License:</label>
            <?php if (!empty($error)): ?>
            <div class="error">
                <?php echo e($error); ?>
            </div>
            <?php endif; ?>
            <input type="text" id="driverLicense" name="driverLicense" required>
        </div>

        <input type="submit" value="Process Rental">
    </form>

    <?php include_once __DIR__ . '/../views/reservation_details_view.php'; ?>
</body>

</html>