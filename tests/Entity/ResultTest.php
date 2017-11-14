<?php   // tests/Entity/ResultTest.php

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;

/**
 * Class ResultTest
 *
 * @package MiW\Results\Tests\Entity
 */
class ResultTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var Result $result
     */
    protected $result;

    const USERNAME = 'uSeR ñ¿?Ñ';
    const POINTS = 2017;
    /**
     * @var \DateTime $_time
     */
    private $_time;


    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->user = new User();
        $this->user->setUsername(self::USERNAME);
        $this->_time = new \DateTime('now');
        $this->result = new Result(
            self::POINTS,
            $this->user,
            $this->_time
        );
    }

    /**
     * Implement testConstructor
     *
     * @covers \MiW\Results\Entity\Result::__construct()
     * @covers \MiW\Results\Entity\Result::getId()
     * @covers \MiW\Results\Entity\Result::getResult()
     * @covers \MiW\Results\Entity\Result::getUser()
     * @covers \MiW\Results\Entity\Result::getTime()
     *
     * @return void
     */
    public function testConstructor()
    {
        $result2 = new Result(10, $this->user, new \DateTime('now'));
        self::assertNotEmpty($result2);
        self::assertEquals(10,$result2->getResult());
        self::assertEquals($this->user, $result2->getUser());
        self::assertEquals(new \DateTime('now'), $result2->getTime());
    }

    /**
     * Implement testGet_Id().
     *
     * @covers \MiW\Results\Entity\Result::getId()
     * @return void
     */
    public function testGet_Id()
    {
        self::assertEquals('0',$this->result->getId());
    }

    /**
     * Implement testUsername().
     *
     * @covers \MiW\Results\Entity\Result::setResult
     * @covers \MiW\Results\Entity\Result::getResult
     * @return void
     */
    public function testResult()
    {
        self::assertEquals(self::POINTS, $this->result->getResult());
    }

    /**
     * Implement testUser().
     *
     * @covers \MiW\Results\Entity\Result::setUser()
     * @covers \MiW\Results\Entity\Result::getUser()
     * @return void
     */
    public function testUser()
    {
        self::assertEquals($this->user, $this->result->getUser());
        self::assertEquals($this->user->getUsername(), $this->result->getUser()->getUsername());
    }

    /**
     * Implement testTime().
     *
     * @covers \MiW\Results\Entity\Result::setTime
     * @covers \MiW\Results\Entity\Result::getTime
     * @return void
     */
    public function testTime()
    {
        self::assertEquals(new \DateTime('now'), $this->result->getTime());
    }

    /**
     * Implement testTo_String().
     *
     * @covers \MiW\Results\Entity\Result::__toString
     * @return void
     */
    public function testTo_String()
    {
        $string = sprintf(
            '%3d - %3d - %20s - %20s',
            $this->result->getId(),
            $this->result->getResult(),
            $this->result->getUser(),
            $this->result->getTime()->format('Y-m-d H:i:s')
        );

        self::assertEquals($string, $this->result->__toString());
    }

    /**
     * Implement testJson_Serialize().
     *
     * @covers \MiW\Results\Entity\Result::jsonSerialize
     * @return void
     */
    public function testJson_Serialize()
    {
        $array = array (
                    'resultado' => array(
                        'id'     => $this->result->getId(),
                        'result' => $this->result->getResult(),
                        'user'   => $this->result->getUser(),
                        'time'   => $this->result->getTime()->format('Y-m-d H:i:s')
                    )
                 );

        self::assertEquals($array, $this->result->jsonSerialize());
    }
}
