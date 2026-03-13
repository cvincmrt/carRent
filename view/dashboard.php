<?php
use App\Cat;
use App\Dog;

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
                        <td><?= $vehicle->getIsAvailable() ? "red" : "green"; ?></td>
                        <td>
                            <?php if($animal->getIsAdopted()):  ?>
                                 <span class="badge bg-success p-2">at home</span>
                                
                            <?php else: ?>
                               
                               <form method="POST">
                                    <input type="hidden" name="animal_id" value="<?= $animal->getId(); ?>">
                                    <input type="submit" name="action" class="btn btn-sm btn-outline-danger" value="adopt">
                                </form>
                            <?php endif; ?>
                        </td>


                        <td><?php 
                            if($animal instanceof Dog){
                                echo $animal->getBreed(); 
                            }elseif($animal instanceof Cat){
                                echo $animal->getIsOutdoor() ? "outdoor" : "indoor";
                            }
                            ?>
                        </td>
                        <td>
                           <form method="POST">
                                <input type="hidden" name="animal_id" value="<?= $animal->getId(); ?>">
                                <input class="btn btn-sm btn-danger" type="submit" name="action" value="delete">
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