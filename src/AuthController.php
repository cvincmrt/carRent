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

        switch($action){
            case "login":
                $this->login();
                break;
            case "logout":
                $this->logout();
                break;
            case "create":
                $this->create();
                break;
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

    private function create(){
        $fUserName = $_POST["username"]?? "";
        $fPassword = $_POST["password"]?? "";
        $role = 2;
       
        if(!$this->validate( $_POST["username"], $_POST["password"])){
            $_SESSION["error"] = "Meno alebo heslo nema pozadovanu dlzku !!!";
            $this->redirect(); 
        }   
            
        $dbUser = $this->userRepo->findByUsername($fUserName);
            if($dbUser){
                $_SESSION["error"] = "Pouzivatel s menom $fUserName uz existuje!!";
                $this->redirect();           
            }

            $user = new User($fUserName,(int)$role);
            $user->setPassword($fPassword);

            $this->userRepo->create($user);

            $_SESSION["success"] = "Registracia prebehla uspesne. Mozete sa prihlasit";
            $this->redirect();
    }

    public function validate($username,$password)
    {
        return (mb_strlen($username) >= 3 && mb_strlen($password) >= 6)? true :false;
    }

    private function redirect(){
        header("Location:index.php");
        exit();
    }
}