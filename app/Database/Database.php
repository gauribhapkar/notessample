<?php
namespace Notes\Database;
use Notes\Config\Config as config;


class Database 
{
    public $conn;

    public function getConnection()
    {
     
     
        try {
            $connection = new config();
            $this->conn = new \PDO("mysql:host=$connection->hostName;dbname=$connection->dbName", $connection->userName, $connection->password);
            return $this->conn;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
public function get($sql)
    {
            $stmt = $this->getConnection()->prepare($sql);

            $stmt->execute();


            $result = $stmt->fetch(\PDO::FETCH_ASSOC);  
            return $result;
    }
    public function put($sql)
    {
          
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lastid = $conn->lastInsertId();
        return $lastid;
    }

public function delete($id, $sql)
    {
        $conn = $this->getConnection();
        $result = $conn->prepare($sql);
        $result->bindValue(":id",$id,\PDO::PARAM_INT);
        if($result->execute())
        return $id;
        else
            return false;

    }

    
}
