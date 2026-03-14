<?php

use App\Truck;
use App\Sedan;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
       <h1>CarRent management</h1><br>

       <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Brand</th>
                    <th scope="col">Model</th>
                    <th scope="col">Daily_rate</th>
                    <th scope="col">Insurance</th>
                    <th scope="col">Is_available</th>
                    <th scope="col">Spec_param</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vehicles as $vehicle): ?>
                    <tr>
                        <td><?= $vehicle->getBrand(); ?></td>
                        <td><?= $vehicle->getModel(); ?></td>
                        <td><?= $vehicle->getDailyRate(); ?></td>
                        <td><?= $vehicle->calculateInsurance(); ?></td>
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId(); ?>">
                                <?php if($vehicle->getIsAvailable()): ?>
                                    <button type="submit" class="btn btn-primary">Return</button>
                                <?php else:?>
                                    <button type="submit" class="btn btn-success">Lend</button>
                                <?php endif; ?>
                            </form>    
                        </td>
                        <td>
                            <?php if($vehicle instanceof Sedan): ?>
                                <span><?= $vehicle->getIsLuxury() ? "luxus" : "standard"; ?></span>
                            <?php elseif($vehicle instanceof Truck): ?>
                                <span><?= $vehicle->getMaxLoad()." ton"; ?></span>
                            <?php endif; ?>     
                        </td>
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId(); ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                       
                    </tr>
                <?php endforeach; ?>        
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>