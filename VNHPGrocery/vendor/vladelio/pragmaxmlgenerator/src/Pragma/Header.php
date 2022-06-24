<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 07/05/2019
 * Time: 16:14
 */

namespace Vladelio\PragmaXmlGenerator\Pragma;


class Header
{
    /** @var string */
    private $fileId;

    /**
     * Header constructor.
     * @param string $fileId
     */
    public function __construct($fileId)
    {
        $this->fileId = $fileId;
    }

    public function toArray()
    {
        return [
            'Date' => date('Ymd'),
            'Field' => $this->fileId,
            'AppId' => 'EINVOICE',
            'Version' => '1.1'
        ];
    }
}