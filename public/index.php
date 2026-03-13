<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Vehicle;
use App\Truck;
use App\Sedan;
use App\Database;
use App\VehicleRepository;

$pdo = new Database();
$connect = $pdo->getConnect();

$repo = new VehicleRepository($connect);

$vehicles = $repo->getAll();



include __DIR__ . "/../view/dashboard.php";





