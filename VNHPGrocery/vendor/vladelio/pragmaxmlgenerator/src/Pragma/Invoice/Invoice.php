<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 07/05/2019
 * Time: 16:15
 */

namespace Vladelio\PragmaXmlGenerator\Pragma\Invoice;


use Vladelio\PragmaXmlGenerator\Pragma\PragmaXmlGeneratorException;

class Invoice
{
    use VAT;

    /** @var string $id */
    private $id;

    /** @var string $id */
    private $docPrefix;

    /** @var int $time */
    private $time;

    /** @var int $registry */
    private $registry;

    /** @var Item[] $items */
    private $items;

    /** @var string $currency */
    private $currency;

    /** @var string $invoiceType */
    protected $invoiceType = 'SF';

    /** @var Buyer $buyer */
    protected $buyer;

    /**
     * Invoice constructor.
     * @param string $id
     * @param string $date
     * @param int $vat
     * @param string $currency
     * @param Buyer $buyer
     * @param int $registry
     * @param boolean $showVat
     * @param string $docPrefix
     * @throws PragmaXmlGeneratorException
     */
    public function __construct($id, $date, $currency, $registry, $buyer, $vat, $showVat = true, $docPrefix = '')
    {
        $this->id = $id;
        $this->vat = $vat;
        $this->currency = $currency;
        $this->sum = 0;
        $this->items = [];
        $this->buyer = $buyer;
        $this->registry = $registry;
        $this->showVat = $showVat;

        if (!$time = strtotime($date)) {
            throw new PragmaXmlGeneratorException('Invalid Invoice Date String');
        }

        $this->time = $time;
        $this->docPrefix = $docPrefix;
    }

    /**
     * @return array
     */
    private function itemArray(): array
    {
        $array = [];
        foreach($this->items as $item) {
            $array[] = $item->toArray();
        }
        return $array;
    }

    /**
     * @return false|string
     */
    private function getDate(): string
    {
        return date('Y-m-d', $this->time);
    }

    /**
     * @param string $serialNumber
     * @param string $sellerProductId
     * @param string $description
     * @param double $sum
     * @param int $quantity
     * @param int $accScheme
     * @param int|null $customWarehouseId
     */
    public function addItem($serialNumber, $sellerProductId, $description, $sum, $quantity, $accScheme, $customWarehouseId = null): void
    {
        $warehouse = $customWarehouseId ?: $this->getDefaultWarehouseId();
        $item = new Item($serialNumber, $sellerProductId, $description, $sum, $this->vat, $quantity, count($this->items) + 1, $accScheme, $warehouse, $this->showVat);
        $this->sum += $item->getSum();
        $this->items[] = $item;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            '_attributes' => [
                'invoiceId' => $this->id,
                'invoiceGlobUniqId' => $this->id,
                'sellerRegNumber' => config('pragmaxmlgenerator.reg_number'),
                'presentment' => 'YES',
                'sellerContractId' => config('pragmaxmlgenerator.contract_id')
            ],
            'InvoiceInformation' => [
                'Type' => [
                    '_attributes' => [
                        'type' => 'DEB',
                    ],
                ],
                'InvoiceNumber' => $this->id,
                'DocumentName' => config('pragmaxmlgenerator.invoice_prefix') . $this->docPrefix,
                'InvoiceContextText' => config('pragmaxmlgenerator.context'),
                'InvoiceDate' => $this->getDate(),
                'DueDate' => $this->getDate(),
                'Registry' => $this->registry,
                'InvoiceType' => $this->invoiceType
            ],
            'InvoiceSumGroup' => [
                'InvoiceSum' => number_format($this->sumBeforeVat(), 2),
                'TotalSum' => number_format($this->sumBeforeVat(), 2),
                'TotalToPay' => $this->sum,
                'Currency' => $this->currency
            ],
            'InvoiceItem' => [
                'InvoiceItemGroup' => [
                    'ItemEntry' => $this->itemArray()
                ]
            ],
            'PaymentInfo' => [
                'Currency' => $this->currency,
                'PaymentDescription' => config('pragmaxmlgenerator.description'),
                'Payable' => 'YES',
                'PayDueDate' => $this->getDate(),
                'PaymentTotalSum' => $this->sum,
                'PaymentId' => $this->id,
                'PayToAccount' => config('pragmaxmlgenerator.pay_to_account'),
                'PayToName' => config('pragmaxmlgenerator.pay_to_name'),
            ]
        ];

        if ($this->showVat) {
            $array['InvoiceSumGroup']['VAT'] = [
                '_attributes' => [
                    'vatId' => 'TAX',
                ],
                'VATSum' => number_format($this->vatSum(), 2),
                'VATRate' => $this->vat
            ];
            $array['InvoiceSumGroup']['TotalVATSum'] = number_format($this->vatSum(), 2);
        }
        $this->appendToArray($array);

        return $array;
    }

    /**
     * @param $array
     */
    protected function appendToArray(&$array): void
    {
        $array['InvoiceParties'] = [
            'SellerParty' => [
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
            'BuyerParty' => $this->buyer->toArray()
        ];
    }

    /**
     * @return string
     */
    protected function getDefaultWarehouseId()
    {
        return config('pragmaxmlgenerator.warehouse_id', '');
    }
}