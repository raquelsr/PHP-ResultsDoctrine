<?php   // tests/Entity/UserTest.php

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package MiW\Results\Tests\Entity
 * @group   users
 */
class UserTest extends TestCase
{
    /**
     * @var User $user
     */
    protected $user;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->user = new User();
        $this->user->setUsername('Raquel');
        $this->user->setEmail('raquel@a.com');
        $this->user->setIsAdmin(true);
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     */
    public function testConstructor()
    {
        $user2 = new User('user2','user2@email.com','user2password',true, true);
        $this->assertEquals(0,$user2->getId());
        $this->assertEquals('user2',$user2->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getId()
     */
    public function testGetId()
    {
        $this->assertEquals(0,$this->user->getId());
    }

    /**
     * @covers \MiW\Results\Entity\User::setUsername()
     * @covers \MiW\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername()
    {
        $this->assertEquals('Raquel',$this->user->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail()
    {
        self::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled()
    {
        self::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::setAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin()
     */
    public function testIsSetAdmin()
    {
        self::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::getPassword()
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testGetSetPassword()
    {
        self::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString()
    {
        self::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize()
    {
        self::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
