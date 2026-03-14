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
                $vehicle->setId((int)$row["id"]);
                $vehicles[] = $vehicle;
            }
        }
        return $vehicles;
    }

    public function delete($vehicle_id){
        $sql = "DELETE FROM vehicles WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id" => $vehicle_id
        ]);
    }

    public function updateAvailable($vehicle_id, $status){

        $new_status = $status ? 0 : 1;

            $sql = "UPDATE vehicles SET is_available = :new_status WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ":new_status" => $new_status,
                "id" => $vehicle_id
            ]);
    }

}