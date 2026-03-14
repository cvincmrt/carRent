<?php

namespace App;

class VehicleController
{
    private VehicleRepository $repo;

    public function __construct(VehicleRepository $repo){
        $this->repo = $repo;
    }

    public function handleRequest(){
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            return;
        }

        $action = $_POST["action"] ?? "";

        switch($action){
            case "createVehicle":
                $this->store();
                break;
            case "delete":
                $this->destroy();
                break;
            case "updateAvailable":
                $this->update();
                break;
        }
    }
    
    public function redirect(){
        header("Location:index.php");
        exit();
    }

    private function update(){
        $this->repo->updateAvailable($_POST["vehicle_id"], $_POST["status"]);
        $this->redirect();
    }

    private function destroy(){
        $this->repo->delete($_POST["vehicle_id"]);
        $this->redirect();
    }

    private function store(){
        $vehicle = null;
        
        $type = $_POST["type"]?? "";
        $brand = $_POST["brand"]?? "";
        $model = $_POST["model"]?? "";
        $daily_rate = $_POST["daily_rate"]?? 0;
        $is_available = $_POST["is_available"] === "Return" ? 1 : 0;
        $spec_param = $_POST["spec_param"] === "luxus" ? 1 : $_POST["spec_param"]; 
        
        if($type === "Sedan"){
            $vehicle = new Sedan($brand, $model, (int)$daily_rate, (int)$is_available, $spec_param);
        }elseif($type === "Truck"){
            $vehicle = new Truck($brand, $model, (int)$daily_rate, (int)$is_available, $spec_param);
        }

        if($vehicle){
            $this->repo->createVehicle($vehicle);
            $this->redirect();
        }
    }

}