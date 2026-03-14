<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Vehicle;
use App\Truck;
use App\Sedan;
use App\Database;
use App\VehicleController;
use App\VehicleRepository;

$pdo = new Database();
$connect = $pdo->getConnect();

$repo = new VehicleRepository($connect);

$controller = new VehicleController($repo);
$controller->handleRequest();

$vehicles = $repo->getAll();

include __DIR__ . "/../view/dashboard.php";





