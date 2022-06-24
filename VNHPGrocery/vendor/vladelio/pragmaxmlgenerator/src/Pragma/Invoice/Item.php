<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 08/05/2019
 * Time: 11:22
 */

namespace Vladelio\PragmaXmlGenerator\Pragma\Invoice;


class Item
{

    use VAT;

    /** @var string $serialNumber */
    private $serialNumber;

    /** @var string $sellerProductId */
    private $sellerProductId;

    /** @var string $description */
    private $description;

    /** @var int $price */
    private $quantity;

    /** @var int $rowNo */
    private $rowNo;

    /** @var int $accScheme */
    private $accScheme;

    /** @var string $warehouse */
    private $warehouse;

    /**
     * Item constructor.
     * @param string $serialNumber
     * @param string $sellerProductId
     * @param string $description
     * @param double $sum
     * @param int $vat
     * @param int $quantity
     * @param int $rowNo
     * @param int $accScheme
     * @param boolean $showVat
     * @param string $warehouse
     */
    public function __construct($serialNumber, $sellerProductId, $description, $sum, $vat, $quantity, $rowNo, $accScheme, $warehouse, $showVat = true)
    {
        $this->serialNumber = $serialNumber;
        $this->sellerProductId = $sellerProductId;
        $this->description = $description;
        $this->sum = $sum;
        $this->vat = $vat;
        $this->quantity = $quantity;
        $this->rowNo = $rowNo;
        $this->accScheme = $accScheme;
        $this->showVat = $showVat;
        $this->warehouse = $warehouse;
    }

    /**
     * @return string
     */
    public function itemPrice(): string
    {
        return number_format($this->sum / $this->quantity, 2);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'RowNo' => $this->rowNo,
            'SerialNumber' => $this->serialNumber,
            'SellerProductId' => $this->sellerProductId,
            'Description' => $this->description,
            'ItemSum' => number_format($this->sumBeforeVat(), 2),
            'AccSchemeID' => $this->accScheme,
            'WarehouseID' => $this->warehouse,
            'ItemDetailInfo' => [
                'ItemAmount' => number_format($this->quantity, 2),
                'ItemPrice' => bcdiv($this->sumBeforeVat(), $this->quantity, 2)
            ],
        ];
        if ($this->showVat) {
            $array['VAT'] = [
                'SumBeforeVAT' => number_format($this->sumBeforeVat(), 2),
                'VATRate' => $this->vat,
                'VATSum' => number_format($this->vatSum(), 2),
                'SumAfterVAT' => $this->sum
            ];
        }
        return $array;
    }
}