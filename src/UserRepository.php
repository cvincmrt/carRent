<?php

namespace App;

class UserRepository
{
    private PDO $db;

    public function __construct(PDO $connect){
        $this->db = $connect;
    }
    
    public function create(User $user){
        $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":username" => $user->getUsername(),
            ":password" => $user->getPassword(),
            ":role" => $user->getRole()
        ]);

    }

    public function findByUsername($username){
        $user = null;

        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([":username" => $username]);

        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $user = new User($row["username"], $row["role"]);
            $user->setHashedPassword($row["password"]);
        }

        if($user){
            return $user;
        }

    }
}