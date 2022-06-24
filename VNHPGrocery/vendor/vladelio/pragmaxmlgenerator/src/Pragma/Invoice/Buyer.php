<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 08/05/2019
 * Time: 13:58
 */

namespace Vladelio\PragmaXmlGenerator\Pragma\Invoice;

class Buyer
{

    const MAX_NAME_LENGTH = 255;
    const MAX_EMAIL_LENGTH = 100;
    const MAX_ADDRESS_LENGTH = 100;
    const MAX_CITY_LENGTH = 50;

    /** @var string $name */
    private $name;

    /** @var string $email */
    private $email;

    /** @var string $address */
    private $address;

    /** @var string $city */
    private $city;

    /** @var string $postalCode */
    private $postalCode;

    /** @var string $countryCode */
    private $countryCode;

    /**
     * Buyer constructor.
     * @param string $name
     * @param string $email
     * @param string $address
     * @param string $city
     * @param string $postalCode
     * @param string $countryCode
     */
    public function __construct($name, $email, $address = '', $city = '', $postalCode = '', $countryCode = '')
    {
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'Name' => substr($this->name, 0, self::MAX_NAME_LENGTH),
            'ContactData' => [
                'ContactName' => substr($this->name, 0, self::MAX_NAME_LENGTH),
                'EmailAddress' => substr($this->email, 0, self::MAX_EMAIL_LENGTH),
                'LegalAddress' => [
                    'PostalAddress1' => substr($this->address, 0, self::MAX_ADDRESS_LENGTH),
                    'City' => substr($this->city, 0, self::MAX_CITY_LENGTH),
                    'PostalCode' => $this->postalCode,
                    'CountryCode' => $this->countryCode,
                ]
            ]
        ];
    }
}