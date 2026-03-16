<?php

namespace App;

class AuthController
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $useRepo){
        $this->userRepo = $userRepo;
    }

    public function handleRequest(){

        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            return;
        }

        $action = $_POST["action"]?? "";

        if($action === "login"){
            $this->login();
        }elseif($action === "logout"){
            $this->logout();
        }
    }

    private function login(){
        

    }

    private function logout(){

    }

    private function redirect(){
        header("Location:index.php");
        exit();
    }


}