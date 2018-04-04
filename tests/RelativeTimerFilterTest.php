<?php

namespace littlesumolabs\tests;

use littlesumolabs\timeago\RelativeTimerFilter as RelativeTimer;

/**
 * Class RelativeTimerFilterTest.
 */
class RelativeTimerFilterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * RelativeTimerFilterTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->relativeTimer = new relativeTimer();
    }

    /**
     * Test for 'OneHourAgo' case.
     */
    public function testOneHourAgo()
    {
        $oneHourAgo = date('d M Y H:i:s', strtotime('-1 hour', strtotime('now')));
        $test = $this->relativeTimer->getRelativeTime($oneHourAgo);

        $this->assertSame('il y a 1 heure', $test);
    }

    /**
     * Test for 'Tomorrow' case.
     */
    public function testTomorrow()
    {
        $tomorrow = date('d M Y H:i:s', strtotime('+ 1 day', strtotime('now')));
        $test = $this->relativeTimer->getRelativeTime($tomorrow);

        $this->assertSame('dans 1 jour', $test);
    }

    /**
     * Test for an 'Other Format' case.
     */
    public function testOtherFormat()
    {
        $tomorrow = date('d M Y', strtotime('+ 1 day', strtotime('now')));
        $test = $this->relativeTimer->getRelativeTime($tomorrow);

        $this->assertRegExp('/[0-9]+ heures/i', $test);
    }

    /**
     * Test another 'Other Format' case.
     */
    public function testAnOtherFormat()
    {
        $yesterday = date('d M Y', strtotime('- 3 month', strtotime('now')));
        $test = $this->relativeTimer->getRelativeTime($yesterday);

        $this->assertRegExp('/[0-9]+ mois/i', $test);
    }
}
