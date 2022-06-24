<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 07/05/2019
 * Time: 16:13
 */

namespace Vladelio\PragmaXmlGenerator\Pragma;


use Spatie\ArrayToXml\ArrayToXml;
use Vladelio\PragmaXmlGenerator\Pragma\Invoice\Invoice;

class EInvoice
{
    /** @var Header $header */
    private $header;

    /** @var Invoices $invoices */
    private $invoices;

    /**
     * EInvoice constructor.
     * @param Header $header
     * @param Invoices $invoices
     */
    public function __construct($header, $invoices)
    {
        $this->header = $header;
        $this->invoices = $invoices;
    }

    public function toXML()
    {
        return ArrayToXml::convert([
            'Header' => $this->header->toArray(),
            'Invoice' => $this->invoices->toArray(),
            'Footer' => [
                'TotalNumberInvoices' => $this->invoices->count(),
                'TotalAmount' => number_format($this->invoices->getAmount(), 2)
            ]
        ], 'E_Invoice');
    }

    /**
     * @param Invoice $invoice
     */
    public function addInvoice(Invoice $invoice)
    {
        $this->invoices->addInvoice($invoice);
    }
}