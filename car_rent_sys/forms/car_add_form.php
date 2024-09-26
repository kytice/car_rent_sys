<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent &#183 Add Car</title>
    <link rel="stylesheet" href="/car_rent_sys/public/css/style.css" />
</head>

<body>
    <?php include __DIR__ . '/../views/sidebar.html'; ?>
    <h2>Add A New Car</h2>
    <form class="form" action="/car_rent_sys/controllers/car_add.php" method="post">
        <div>
            Registration Number:
            <input type="text" name="RegNum" value="<?php echo e($carData['RegNum']); ?>" required>
        </div>

        <div>
            Type:
            <select name="TypeID" required>
                <option value="">---Select---</option>
                <?php
                $carTypes = fetchAllCarTypes($pdo);
                foreach ($carTypes as $type) {
                    $selected = $carData['TypeID'] == $type['TypeID'] ? ' selected' : '';
                    echo "<option value=\"" . e($type['TypeID']) . "\"" . $selected . ">" . e($type['TypeName']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div>
            Make:
            <select name="Make" required>
                <option value="">---Select---</option>
                <?php
                $makes = ['Audi', 'BMW', 'Ford', 'Honda', 'Hyundai', 'Kia', 'Mazda', 'Mercedes-Benz', 'Nissan', 'Opel', 'Peugeot',  'Porsche', 'Renault', 'Skoda', 'Toyota', 'Volkswagen'];
                foreach ($makes as $make) {
                    $selectedMake = $carData['Make'] == $make ? ' selected' : '';
                    echo "<option value=\"" . e($make) . "\"" . $selectedMake . ">" . e($make) . "</option>";
                }
                ?>
            </select>
        </div>

        <div>
            Model:
            <input type="text" name="Model" value="<?php echo e($carData['Model']); ?>" required>
        </div>

        <div>
            Capacity:
            <input type="number" name="Capacity" value="<?php echo e($carData['Capacity']); ?>" min="1" max="12"
                required>
        </div>

        <div>
            Transmission:
            <select name="Trans" required>
                <option value="">---Select---</option>
                <option value="Automatic" <?php echo $carData['Trans'] == 'Automatic' ? ' selected' : ''; ?>>Automatic
                </option>
                <option value="Manual" <?php echo $carData['Trans'] == 'Manual' ? ' selected' : ''; ?>>Manual</option>
            </select>
        </div>

        <div>
            Mileage:
            <input type="number" name="Mileage" value="<?php echo e($carData['Mileage']); ?>" min="0" required>
        </div>

        <div>
            Fuel Type:
            <select name="FuelType" required>
                <option value="">---Select---</option>
                <option value="Petrol" <?php echo $carData['FuelType'] == 'Petrol' ? ' selected' : ''; ?>>Petrol
                </option>
                <option value="Diesel" <?php echo $carData['FuelType'] == 'Diesel' ? ' selected' : ''; ?>>Diesel
                </option>
                <option value="Electric" <?php echo $carData['FuelType'] == 'Electric' ? ' selected' : ''; ?>>Electric
                </option>
                <option value="Hybrid" <?php echo $carData['FuelType'] == 'Hybrid' ? ' selected' : ''; ?>>Hybrid
                </option>
            </select>
        </div>

        <input type="submit" name="submit" value="Submit">
    </form>
    <button class="back-btn" onclick="history.back()">Back</button>
</body>

</html>