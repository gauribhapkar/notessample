<?php

namespace samplemvc\Mapper;

require_once '../../vendor/autoload.php';

    use samplemvc\Mapper\User as UserMapper;

class UserTest extends \PHPUnit_Extensions_Database_TestCase
{
    public function getConnection()
    {
        $dbhost   = "localhost";
        $dbname   = "user1";
        $dbuser   = "root";
        $dbpass   = "Dbtest123";

        $pdo = new \PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        return $this->createDefaultDBConnection($pdo, $dbname);
    }


    public function testIsCountIncreased()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('user'), "Pre-Condition");

        //add new user
        $input=array('firstName'=>'gaurii','lastName'=>'bhapkarr','email'=>'gaurii@bhapkarr.com');
        $userMapper=new UserMapper();

        $userMapper->create($input);

        $this->assertEquals(3, $this->getConnection()->getRowCount('user'), "Inserting failed");

    }


    public function testCanReadUserById()
    {
        $userMapper=new UserMapper();
        $user=$userMapper->read('1');
        $this->assertEquals('gau', $user->firstName);
    }

    

    /**
    *  @expectedException Exception
    *  @expectedExceptionMessage User not found.
    **/
    public function testThrowsExceptionOnUserNotPresent()
    {
        $userMapper=new UserMapper();
        $user=$userMapper->read('10');
        
    }


    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__).'/files/user-seed.xml');
    }
}
