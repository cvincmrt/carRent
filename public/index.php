<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Vehicle;
use App\Truck;
use App\Sedan;


$car = new Sedan("Skoda", "Octavia", 10, 1, 1);

var_dump($car);