<?php 
require_once __DIR__ . '/../utils/functions.php';

$resId = $_GET['resid']; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Process Return</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../views/sidebar.html'; ?>

    <h2>Process Return</h2>

    <div class="form">
        <p><?php echo e($priceMsg); ?></p>
    </div>

    <form class="form" action="../controllers/process_return.php?resid=<?php echo e($resId); ?>" method="post">
        <div class="form-group">
            <label for="mileage">Mileage:</label>
            <?php if (!empty($error)): ?>
            <div class="alert error">
                <?php echo e($error); ?>
            </div>
            <?php endif; ?>

            <input type="number" id="mileage" name="mileage" required title="Please enter the updated mileage"
                value="<?php echo e($resDetails['Mileage']); ?>">
        </div>

        <input type="submit" value="Process Return">
    </form>

    <?php include_once __DIR__ . '/../views/reservation_details_view.php'; ?>
</body>

</html>