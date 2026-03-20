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

            $sql = "UPDATE vehicles SET is_available = :new_status WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ":new_status" => $status,
                "id" => $vehicle_id
            ]);
    }

    public function createVehicle(Vehicle $vehicle){
        
        $type = basename(get_class($vehicle));

        $sql = "INSERT INTO vehicles (type, brand, model, daily_rate, is_available, spec_param) VALUES (:type, :brand, :model, :daily_rate, :is_available, :spec_param)";

        $stmt = $this->db->prepare($sql);

        if($vehicle instanceof Sedan){
            $spec_param = $vehicle->getIsLuxury();
        }elseif($vehicle instanceof Truck){
            $spec_param = $vehicle->getMaxLoad();
        }

        return $stmt->execute([
            ":type" => $type,
            ":brand" => $vehicle->getBrand(),
            ":model" => $vehicle->getModel(),
            ":daily_rate"  => $vehicle->getDailyRate(),
            ":is_available"  => $vehicle->getIsAvailable(),
            ":spec_param"  => $spec_param
        ]);
        
    }

    public function addRental(int $user_id, int $vehicleId)
    {
        $sql ="INSERT INTO rentals (user_id, vehicle_id) VALUES (:user_id, :vehicle_id)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":user_id" => $user_id,
            ":vehicle_id" => $vehicleId
        ]);
    }

    public function getRentalHistory(){
        $sql = "SELECT rentals.rented_at,users.username,vehicles.brand,vehicles.model FROM rentals 
                JOIN users ON rentals.user_id = users.id
                JOIN vehicles ON rentals.vehicle_id = vehicles.id
                ORDER BY rentals.rented_at DESC";
        
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}