<?php

namespace App;

class AuthController
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo){
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
        $fUserName = $_POST["username"]?? "";
        $fPassword = $_POST["password"]?? "";

        $user = $this->userRepo->findByUsername($fUserName);

        if($user && password_verify($fPassword,$user->getPassword())){

            $_SESSION["user_id"] = $user->getId();
            $_SESSION["username"] = $user->getUsername();
            $_SESSION["role"] = $user->getRole();
        }

        $this->redirect();
    }

    private function logout(){
        session_destroy();
        $this->redirect();
    }

    private function redirect(){
        header("Location:index.php");
        exit();
    }
}