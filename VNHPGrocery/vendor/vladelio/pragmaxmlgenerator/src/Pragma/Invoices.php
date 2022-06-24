<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 07/05/2019
 * Time: 16:35
 */

namespace Vladelio\PragmaXmlGenerator\Pragma;


use Vladelio\PragmaXmlGenerator\Pragma\Invoice\Invoice;

class Invoices
{
    /** @var Invoice[] */
    private $invoices;

    /** @var double $amount */
    private $amount;

    public function __construct()
    {
        $this->invoices = [];
        $this->amount = 0.0;
    }

    /**
     * @param Invoice $invoice
     */
    public function addInvoice(Invoice $invoice): void
    {
        $this->invoices[] = $invoice;
        $this->amount += $invoice->getSum();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach($this->invoices as $invoice) {
            $array[] = $invoice->toArray();
        }
        return $array;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->invoices);
    }
}