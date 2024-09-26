 <table class="car-table">
     <tr>
         <th>RegNum</th>
         <th>Make</th>
         <th>Model</th>
         <th>DailyRate</th>
         <th>Capacity</th>
         <th>Trans</th>
         <th>Actions</th>
     </tr>

     <?php if (isset($availableCars) && !empty($availableCars)): ?>
     <?php foreach ($availableCars as $car): ?>
     <tr>
         <td><?php echo e($car['RegNum']); ?></td>
         <td><?php echo e($car['Make']); ?></td>
         <td><?php echo e($car['Model']); ?></td>
         <td><?php echo e($car['DailyRate']); ?></td>
         <td><?php echo e($car['Capacity']); ?></td>
         <td><?php echo e($car['Trans']); ?></td>
         <td>
             <a href="../views/car_details_view.php?regnum=<?php echo e($car['RegNum']); ?>">View</a> |
             <a
                 href="reservation_completion_form.php?carId=<?php echo e($car['CarID']); ?>&pickupDate=<?php echo e($_POST['pickupDate']); ?>&estReturnDate=<?php echo e($_POST['estReturnDate']); ?>">Reserve</a>
         </td>
     </tr>
     <?php endforeach; ?>
     <?php else: ?>
     <tr>
         <td colspan="7">No cars available for the selected dates.</td>
     </tr>
     <?php endif; ?>
 </table>