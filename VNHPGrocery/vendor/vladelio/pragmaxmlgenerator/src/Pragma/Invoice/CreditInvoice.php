<?php


namespace Vladelio\PragmaXmlGenerator\Pragma\Invoice;


use Vladelio\PragmaXmlGenerator\Pragma\PragmaXmlGeneratorException;

class CreditInvoice extends Invoice
{
    /** @var string $invoiceType */
    protected $invoiceType = 'KS';

    /** @var string|null $referenceDocId */
    private $referenceDocId;

    /**
     * Invoice constructor.
     * @param string $id
     * @param string $date
     * @param int $vat
     * @param string|null $referenceDocId
     * @param string $currency
     * @param Buyer $buyer
     * @param int $registry
     * @param boolean $showVat
     * @param string $docPrefix
     * @throws PragmaXmlGeneratorException
     */
    public function __construct($id, $date, $currency, $registry, $buyer, $vat, $referenceDocId, $showVat = true, $docPrefix = '')
    {
        $this->referenceDocId = $referenceDocId;
        parent::__construct($id, $date, $currency, $registry, $buyer, $vat, $showVat, $docPrefix);
    }

    /**
     * @param $array
     */
    protected function appendToArray(&$array): void
    {
        $array['InvoiceParties'] = [
            'SellerParty' => $this->buyer->toArray(),
            'BuyerParty' => [
                'Name' => config('pragmaxmlgenerator.name'),
                'RegNumber' => config('pragmaxmlgenerator.reg_number'),
                'VATRegNumber' => config('pragmaxmlgenerator.vat_reg_number'),
                'ContactData' => [
                    'EmailAddress' => config('pragmaxmlgenerator.email'),
                    'LegalAddress' => [
                        'PostalAddress1' => config('pragmaxmlgenerator.postal_address'),
                        'City' => config('pragmaxmlgenerator.city'),
                    ]
                ]
            ],
        ];
        if ($this->referenceDocId) {
            $array['InvoiceInformation']['PayBackDocumentNumber'] = $this->referenceDocId;
        }
    }

    /**
     * @return string
     */
    protected function getDefaultWarehouseId()
    {
        return config('pragmaxmlgenerator.warehouse_returns_id', config('pragmaxmlgenerator.warehouse_id', ''));
    }
}