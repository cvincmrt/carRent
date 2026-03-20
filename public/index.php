<?php
session_start();

require_once __DIR__ . "/../vendor/autoload.php";

use App\Vehicle;
use App\Truck;
use App\Sedan;
use App\Database;
use App\User;
use App\VehicleController;
use App\VehicleRepository;
use App\AuthController;
use App\UserRepository;


$pdo = new Database();
$connect = $pdo->getConnect();

$userRepo = new UserRepository($connect);
$authController = new AuthController($userRepo);
$authController->handleRequest();

$repo = new VehicleRepository($connect);
$controller = new VehicleController($repo);
$controller->handleRequest();

$vehicles = $repo->getAll();
$history = $repo->getRentalHistory();



include __DIR__ . "/../view/dashboard.php";





