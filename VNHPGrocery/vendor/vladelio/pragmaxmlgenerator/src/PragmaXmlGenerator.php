<?php

namespace Vladelio\PragmaXmlGenerator;

use Vladelio\PragmaXmlGenerator\Pragma\EInvoice;
use Vladelio\PragmaXmlGenerator\Pragma\Header;
use Vladelio\PragmaXmlGenerator\Pragma\Invoice\Buyer;
use Vladelio\PragmaXmlGenerator\Pragma\Invoice\CreditInvoice;
use Vladelio\PragmaXmlGenerator\Pragma\Invoice\Invoice;
use Vladelio\PragmaXmlGenerator\Pragma\Invoices;
use Vladelio\PragmaXmlGenerator\Pragma\PragmaXmlGeneratorException;

class PragmaXmlGenerator
{
    /** @var EInvoice $einvoice */
    private $einvoice;

    /** @var Invoice|null $pendingInvoice */
    private $pendingInvoice;

    public function generateXml()
    {
        if (!$this->einvoice) {
            throw new \Exception('EInvoice not initialized');
        }
        return $this->einvoice->toXML();
    }

    /**
     * @param string $fileId
     */
    public function init($fileId): void
    {
        $this->einvoice = new EInvoice(new Header($fileId), new Invoices());
    }

    /**
     * @param string $id
     * @param string $date
     * @param int $vat
     * @param string $currency
     * @param string $name
     * @param string $email
     * @param int $registry
     * @param string $address
     * @param string $city
     * @param string $postalCode
     * @param string $countryCode
     * @param bool $showVat
     * @throws PragmaXmlGeneratorException
     */
    public function buildInvoice($id, $date, $vat, $currency, $name, $email, $registry = 0, $address = '', $city = '', $postalCode = '', $countryCode = '', $showVat = true): void
    {
        $this->pendingInvoice = new Invoice($id, $date, $currency, $registry,
            new Buyer($name, $email, $address, $city, $postalCode, $countryCode), $vat, $showVat);
    }

    /**
     * @param string $id
     * @param string $date
     * @param int $vat
     * @param string $currency
     * @param string $name
     * @param string $email
     * @param string $referenceDocId
     * @param int $registry
     * @param string $address
     * @param string $city
     * @param string $postalCode
     * @param string $countryCode
     * @param bool $showVat
     * @throws PragmaXmlGeneratorException
     */
    public function buildCreditInvoice($id, $date, $vat, $currency, $name, $email, $referenceDocId, $registry = 0, $address = '', $city = '', $postalCode = '', $countryCode = '', $showVat = true): void
    {
        $this->pendingInvoice = new CreditInvoice($id, $date, $currency, $registry,
            new Buyer($name, $email, $address, $city, $postalCode, $countryCode),
            $vat, $referenceDocId, $showVat, 'r');
    }


    /**
     * @param string $serialNumber
     * @param string $sellerProductId
     * @param string $description
     * @param double $sum
     * @param int $quantity
     * @param int $accScheme
     * @param int|null $customWarehouseId
     * @throws PragmaXmlGeneratorException
     */
    public function addItem($serialNumber, $sellerProductId, $description, $sum, $quantity, $accScheme, $customWarehouseId = null): void
    {
        $this->checkInvoice();
        $this->pendingInvoice->addItem($serialNumber, $sellerProductId, $description, $sum, $quantity, $accScheme, $customWarehouseId);
    }

    /**
     * @throws PragmaXmlGeneratorException
     */
    public function commitInvoice(): void
    {
        $this->checkInvoice();
        $this->einvoice->addInvoice($this->pendingInvoice);
        $this->pendingInvoice = null;
    }

    /**
     * @throws PragmaXmlGeneratorException
     */
    private function checkInvoice(): void
    {
        if (!$this->pendingInvoice) {
            throw new PragmaXmlGeneratorException('Invoice not built');
        }
    }


}