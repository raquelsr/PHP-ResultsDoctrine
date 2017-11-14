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
        $this->user->setUsername('user1');
        $this->user->setEmail('user1@mail.com');
        $this->user->setIsAdmin(true);
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     */
    public function testConstructor()
    {
        $user2 = new User('user2','user2@mail.com','user2password',true, true);
        self::assertEquals(0,$user2->getId());
        self::assertEquals('user2',$user2->getUsername());
        self::assertEquals('user2@mail.com', $user2->getEmail());
        self::assertNotEmpty($user2->getPassword());
        self::assertEquals(true, $user2->isEnabled());
        self::assertEquals(true, $user2->isAdmin());
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
        self::assertEquals('user1',$this->user->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail()
    {
        self::assertEquals('user1@mail.com', $this->user->getEmail());
    }

    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled()
    {
        $this->user->setEnabled(false);
        self::assertEquals(false, $this->user->isEnabled());
    }

    /**
     * @covers \MiW\Results\Entity\User::setAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin()
     */
    public function testIsSetAdmin()
    {
        self::assertEquals(true, $this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::getPassword()
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testGetSetPassword()
    {
        $validate = $this->user->validatePassword('password');
        self::assertNotEmpty($this->user->getPassword());
        self::assertFalse($validate, $this->user->getPassword());
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString()
    {
        self::assertEquals('user1', $this->user->__toString());
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize()
    {
        $arrayJSON = array (
                        'user' => array(
                            'id'            => $this->user->getId(),
                            'username'      => utf8_encode($this->user->getUsername()),
                            'email'         => utf8_encode($this->user->getEmail()),
                            'enabled'       => $this->user->isEnabled(),
                            'admin'         => $this->user->isAdmin()
                        )
                    );

        self::assertEquals($arrayJSON, $this->user->jsonSerialize());

    }
}
