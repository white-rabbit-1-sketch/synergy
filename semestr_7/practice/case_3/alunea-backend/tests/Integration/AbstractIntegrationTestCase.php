<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Clock\Clock;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\Clock\MockClock;

class AbstractIntegrationTestCase extends KernelTestCase
{
    protected static ClockInterface $originalClock;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::bootKernel();
        self::$originalClock = Clock::get();
        Clock::set(new MockClock());
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        Clock::set(self::$originalClock);
    }
}