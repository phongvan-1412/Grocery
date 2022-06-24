<?php
/**
 * Created by PhpStorm.
 * User: vladelis
 * Date: 08/05/2019
 * Time: 13:40
 */

namespace Vladelio\PragmaXmlGenerator\Pragma;


use Throwable;

class PragmaXmlGeneratorException extends \Exception
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Pragma XML Exception: ' . $message, $code, $previous);
    }
}