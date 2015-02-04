<?php

namespace samplemvc\Mapper;

require_once '../../vendor/autoload.php';

use samplemvc\Model\User as UserModel;

//include_once(config/connect.php');

class User
{
    
    public function create($input)
    {
        
        $user = new UserModel();
        
        $user->firstName = $input['firstName'];
        $user->lastName  = $input['lastName'];
        $user->email     = $input['email'];
        
        //should create domain
        $dbhost = "localhost";
        $dbname = "user1";
        $dbuser = "root";
        $dbpass = "Dbtest123";
        
        $conn = new \PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        
        $sql = "INSERT INTO user (firstName,lastName,email) VALUES (:firstName,:lastName,:email)";
        $q   = $conn->prepare($sql);
        $q->execute(array(
            ':firstName' => $user->firstName,
            ':lastName' => $user->lastName,
            ':email' => $user->email
        ));
        $user->id = $conn->lastInsertId();
        
        
        
        return $user;
    }
    
    
    public function read($id)
    {
        
        $user     = new UserModel();
        $user->id = $id;
        
        //read this user from db
        $dbhost = "localhost";
        $dbname = "user1";
        $dbuser = "root";
        $dbpass = "Dbtest123";
        
        $conn = new \PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        
        $sql = "select id,firstName,lastName,email from user where id=:id";
        $q   = $conn->prepare($sql);
        $q->execute(array(
            ':id' => $user->id
        ));
        
        $resultset = $q->fetch(\PDO::FETCH_ASSOC);
        
        if ($q->rowCount() == 0) {
            throw new \Exception("User not found.");
            
        } else {
            //create user model from resultset
            
            $user->firstName = $resultset['firstName'];
            $user->lastName  = $resultset['lastName'];
            $user->email     = $resultset['email'];
            
            
            return $user;
        }
    }
}
