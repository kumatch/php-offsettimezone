<?php

namespace Kumatch\Test\OffsetTimeZone;

use Kumatch\OffsetTimeZone\OffsetTimeZone;
use DateTime;
use DateTimeZone;

class OffsetTimeZoneTest extends \PHPUnit_Framework_TestCase
{
    /** @var  OffsetTimeZone */
    protected $offsetTimeZone;

    protected function setUp()
    {
        parent::setUp();

        $this->offsetTimeZone = new OffsetTimeZone();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    protected function assertDateTimeZone(DateTimeZone $timezone, $offset)
    {
        $utc = new DateTime('now', new DateTimeZone('UTC'));

        $this->assertInstanceOf('DateTimeZone', $timezone);
        $this->assertEquals($offset, $timezone->getOffset($utc));
    }

    public function testCreateMatchesTimeZone()
    {
        for ($i = 0; $i < 12; ++$i) {
            $offset = $i * 3600;
            $this->assertDateTimeZone($this->offsetTimeZone->createTimeZone($offset), $offset);
            $this->assertDateTimeZone($this->offsetTimeZone->createTimeZone($offset * -1), $offset * -1);
        }
    }

    public function testCreateNearsTimeZone()
    {
        $this->assertDateTimeZone($this->offsetTimeZone->createTimeZone(10), 0);
        $this->assertDateTimeZone($this->offsetTimeZone->createTimeZone(-10), 0);

        $this->assertDateTimeZone($this->offsetTimeZone->createTimeZone(3500), 3600);
        $this->assertDateTimeZone($this->offsetTimeZone->createTimeZone(-3500), -3600);
    }

    public function testNotCreateNearsTimeZone()
    {
        $this->assertDateTimeZone($this->offsetTimeZone->createTimeZone(0, false), 0);
        $this->assertNull($this->offsetTimeZone->createTimeZone(10, false));
        $this->assertNull($this->offsetTimeZone->createTimeZone(12345678, false));
    }
}