<?php
namespace Notes\Model;

use Notes\Model\User;
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateObject()
    {
        $user   = new User();
        $this->assertInstanceOf('Notes\Model\User', $user);
    }
}
