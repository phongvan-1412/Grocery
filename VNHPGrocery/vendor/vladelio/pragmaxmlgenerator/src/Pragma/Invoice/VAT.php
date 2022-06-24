<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 08/05/2019
 * Time: 11:55
 */

namespace Vladelio\PragmaXmlGenerator\Pragma\Invoice;


trait VAT
{
    /** @var int $vat */
    private $vat;

    /** @var double $sum */
    private $sum;

    /** @var boolean $showVat */
    private $showVat;

    /**
     * @return float|int
     */
    private function sumBeforeVat()
    {
        return $this->showVat ? ($this->sum - $this->vatSum()) : $this->sum;
    }

    /**
     * @return float|int
     */
    private function vatSum()
    {
        return round($this->sum * $this->vat / ($this->vat + 100), 2);
    }

    /**
     * @return int
     */
    public function getVat(): int
    {
        return $this->vat;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }
}