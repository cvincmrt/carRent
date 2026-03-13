<?php

namespace App;

use PDO;


class VehicleRepository
{
    private PDO $db;

    public function __construct(PDO $connect){
        $this->db = $connect;
    }

    public function getAll(){
        $sql = "SELECT * FROM vehicles";
        $stmt = $this->db->query($sql);

        $vehicles = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $vehicle = null;

            if($row["type"] === "Sedan"){
                $vehicle = new Sedan($row["brand"], $row["model"], (int)$row["daily_rate"], (int)$row["is_available"], $row["spec_param"]);
            }elseif($row["type"] === "Truck"){
                $vehicle = new Truck($row["brand"], $row["model"], (int)$row["daily_rate"], (int)$row["is_available"], $row["spec_param"]);
            }
               

            if($vehicle){
                $vehicles[] = $vehicle;
            }
        }
        return $vehicles;
    }

}