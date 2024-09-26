<?php
require __DIR__ . '/../repositories/car_repository.php';
require __DIR__ . '/../utils/functions.php'; 

$regNum = $_GET['regnum'];
$car = fetchCarByRegNum($pdo, $regNum);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Update Car</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../views/sidebar.html'; ?>
    <h2>Update Car</h2>
    <form class="form" action="/car_rent_sys/controllers/car_update.php" method="post">

        <div>
            Registration Number:
            <input type="text" name="RegNum" value="<?php echo e($car['RegNum']); ?>" readonly>
        </div>
        <div>
            Type:
            <select name="TypeID" required>
                <?php
            $carTypes = fetchAllCarTypes($pdo);
            foreach ($carTypes as $type) {
                $selected = ($car['TypeID'] == $type['TypeID']) ? 'selected' : '';
                echo "<option value=\"{$type['TypeID']}\" $selected>" . e($type['TypeName']) . "</option>";
            }
            ?>
            </select>
        </div>
        <div>
            Make:
            <select name="Make" required>
                <?php
            $makes = ['Audi', 'BMW', 'Ford', 'Honda', 'Hyundai', 'Kia', 'Mazda', 'Mercedes-Benz', 'Nissan', 'Opel', 'Peugeot', 'Porsche', 'Renault', 'Skoda', 'Toyota', 'Volkswagen'];
            foreach ($makes as $make) {
                $selectedMake = ($car['Make'] == $make) ? 'selected' : '';
                echo "<option value=\"$make\" $selectedMake>" . e($make) . "</option>";
            }
            ?>
            </select>
        </div>
        <div>
            Model:
            <input type="text" name="Model" value="<?php echo e($car['Model']); ?>" required>
        </div>
        <div>
            Capacity:
            <input type="number" name="Capacity" value="<?php echo e($car['Capacity']); ?>" min="1" max="12" required>
        </div>
        <div>
            Transmission:
            <select name="Trans" required>
                <option value="Automatic" <?php echo ($car['Trans'] == 'Automatic') ? 'selected' : ''; ?>>Automatic
                </option>
                <option value="Manual" <?php echo ($car['Trans'] == 'Manual') ? 'selected' : ''; ?>>Manual</option>
            </select>
        </div>
        <div>
            Mileage:
            <input type="number" name="Mileage" value="<?php echo e($car['Mileage']); ?>" min="0" required>
        </div>
        <div>
            Fuel Type:
            <select name="FuelType" required>
                <option value="Petrol" <?php echo ($car['FuelType'] == 'Petrol') ? 'selected' : ''; ?>>Petrol</option>
                <option value="Diesel" <?php echo ($car['FuelType'] == 'Diesel') ? 'selected' : ''; ?>>Diesel</option>
                <option value="Electric" <?php echo ($car['FuelType'] == 'Electric') ? 'selected' : ''; ?>>Electric
                </option>
                <option value="Hybrid" <?php echo ($car['FuelType'] == 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
            </select>
        </div>
        <div>
            <input type="submit" name="submit" value="Update">
        </div>
    </form>

    <button class="back-btn" onclick="history.back()">Back</button>
</body>

</html>