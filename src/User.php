<?php

namespace App;

class User
{
    private ?int $id = null;
    private string $username;
    private string $password;
    private int $role;

    public const ROLE_ADMIN = 1;
    public const ROLE_USER = 2;

    public function __construct(string $username, int $role){
        $this->username = $username;
        $this->role = $role;
    }

    // pouzijem pri registracii noveho uzivatela
    public function setPassword($password){
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    //pouzijem pri nacitani z databazy(uy netreba hashovat)
    public function setHashedPassword($hash){
        $this->password = $hash;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }
    public function getRole(){
        return $this->role;
    }
    public function getPassword(){
        return $this->password;
    }


}