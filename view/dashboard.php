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
        <style>
            .row{
                margin-top: 0;
            }
            
            .row .col:last-child{
                text-align: right;  
            }
        </style>

    </head>
  <body>
   
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Prihlásený ako: <strong><?= $_SESSION['username'] ?></strong> (Rola: <?= $_SESSION['role'] == 1 ? 'Admin' : 'User' ?>)</span>
                <form action="index.php" method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="btn btn-outline-danger btn-sm">Odhlásiť sa</button>
                </form>
            <?php else: ?>
                <form action="index.php" method="POST" class="row g-2">
                    <input type="hidden" name="action" value="login">
                    <div class="col-auto"><input type="text" name="username" class="form-control" placeholder="Meno" required></div>
                    <div class="col-auto"><input type="password" name="password" class="form-control" placeholder="Heslo" required></div>
                    <div class="col-auto"><button type="submit" class="btn btn-primary">Prihlásiť</button></div>
                </form>
            <?php endif; ?>
        </div>
        <?php if (!isset($_SESSION['user_id'])): ?>
    <div class="row">
        <div class="col-md-6 border-end">
            <h3>Prihlásenie</h3>
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="login">
                <input type="text" name="username" class="form-control mb-2" placeholder="Meno" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Heslo" required>
                <button type="submit" class="btn btn-primary w-100">Vstúpiť</button>
            </form>
        </div>
        
        <div class="col-md-6">
            <h3>Nová registrácia</h3>
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="create">
                <input type="text" name="username" class="form-control mb-2" placeholder="Zvoľte meno" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Zvoľte heslo" required>
                <button type="submit" class="btn btn-success w-100">Vytvoriť účet</button>
            </form>
        </div>
    </div>
<?php endif; ?>

        <h1>CarRent management</h1><br>

        <?php if(isset($_SESSION["username"]) && $_SESSION["role"] === 1): ?>
            <?php include "addVehicle.php"; ?>
        <?php endif; ?>

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
                                <input type="hidden" name="action" value="updateAvailable">
                                <input type="hidden" name="status" value="<?= $vehicle->getIsAvailable(); ?>">
                                <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId(); ?>">
                                <?php if($vehicle->getIsAvailable()): ?>
                                    <button type="submit" class="btn btn-warning">Return</button>
                                <?php else:?>
                                    <button type="submit" class="btn btn-success">&nbsp&nbspLend&nbsp</button>
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