<?php
namespace samplemvc\Model;

require_once '../../vendor/autoload.php';

use samplemvc\Model\User as UserModel;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateObject()
    {
        $u = new UserModel();
        $this->assertInstanceOf('samplemvc\Model\User', $u);
    }
}
