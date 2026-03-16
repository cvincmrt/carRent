<?php

namespace App;

use PDO;

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

    public function findByUsername($username): ?User
    {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([":username" => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return null;
        }
        
        $user = new User($row["username"], (int)$row["role"]);
        $user->setId((int)$row["id"]);
        $user->setHashedPassword($row["password"]);
        
        return $user;
    }
}