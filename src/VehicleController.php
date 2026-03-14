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
            case "create":
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
}