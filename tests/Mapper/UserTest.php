<?php
namespace Notes\Mapper;

use Notes\Mapper\User as UserMapper;
use Notes\Model\User as UserModel;

class UserTest extends \PHPUnit_Extensions_Database_TestCase
{
    public function getConnection()
    {
        try {
            $conn = null;
            $pdo = new \PDO('mysql:host=localhost;dbname=Notes', 'developer', 'test123');
            $this->conn = $this->createDefaultDBConnection($pdo, "Notes");
            return $this->conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__).'/files/user-seed.xml');
    }
     public function testCanReadUserById()
    {
        $userMapper = new UserMapper();
        $user       = $userMapper->read('1');
        $this->assertEquals('Gauri', $user->firstName);
    }

    public function testIsCountIncreased()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('user'), "Pre-Condition");
        
        
        $input      = array(
            'firstName' => 'nilam',
            'lastName' => 'bora',
            'email' => 'nilu@bora.com'
        );
        $userMapper = new UserMapper();
        
        $userMapper->create($input);
        
        $this->assertEquals(3, $this->getConnection()->getRowCount('user'), "Inserting failed");
        
    }
    
     public function testIsCountDecreased()
    {
       
        $userMapper = new UserMapper();
        
        
        
        $this->assertEquals(3, $userMapper->delete('3'));
        
    }
   
    
    
}
