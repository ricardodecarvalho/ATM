<?php
namespace Atm;

/**
 * Class Atm
 * @package Atm
 *
 * Algorithm simulating an ATM.
 *
 */

class Atm
{
    /**
     * @var int
     */
    private $requested = 0;

    /**
     * @var float
     */
    private $limit = 2000.00;

    /**
     * @var float
     */
    private $balance = 958.33;

    /**
     * @var array
     */
    private $cash_out = [];

    /**
     * @param $requested
     * @return array
     */
    public function cashOut($requested)
    {
        $this->requested = $requested;

        try {
            $this->generalValidation();
        } catch (\RuntimeException $e) {
            die($e->getMessage());
        }

        return $this->cash_out;

    }

    private function generalValidation()
    {
        $this->formatMoney();
        $this->checkLimit();
        $this->checkBalance();
        $this->magic();
    }

    /**
     * @return array
     */
    private function bankNotes()
    {
        return [100, 50, 20, 10];
    }

    private function formatMoney()
    {
        $this->requested = (float) str_replace(',', '.', str_replace('.', '', $this->requested));
    }

    private function checkLimit()
    {
        if($this->requested > $this->limit) {
            throw new \RuntimeException('REQUIRED VALUE EXCEEDING THE DAILY LIMIT');
        }
    }
    
    private function checkBalance()
    {
        if($this->requested > $this->balance){
            throw new \RuntimeException('INSUFFICIENT FUNDS');
        }
    }

    /**
     * @return array
     */
    private function magic()
    {
        foreach ($this->bankNotes() as $value){
            $amount_by_value = floor ($this->requested / $value);
            $this->requested -= $value * $amount_by_value;
            $this->cash_out[$value] = $amount_by_value;
        }
        if ($this->requested != 0) {
            throw new \RuntimeException('VALUE REQUESTED IS NOT VALID');
        }
    }

}

$atm = new Atm();
var_dump($atm->cashOut('80'));