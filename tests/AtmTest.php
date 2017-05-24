<?php

/**
 * Class AtmTest
 */
class AtmTest extends PHPUnit_Framework_TestCase
{
    public function testCashOut()
    {
        $atm = new \Atm\Atm();
        $atm->cashOut("80");
        $this->assertEquals(
            array(
                100 => 0,
                50 => 1,
                20 => 1,
                10 => 1,
            ), $atm->cashOut("80")
        );
    }
}
