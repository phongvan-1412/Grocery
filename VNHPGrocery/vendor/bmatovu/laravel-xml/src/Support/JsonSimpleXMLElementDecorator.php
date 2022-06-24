<?php

namespace Bmatovu\LaravelXml\Support;

use JsonSerializable;
use SimpleXMLElement;

/**
 * Class JsonSimpleXMLElementDecorator.
 *
 * @package Bmatovu\LaravelXml\Support
 * Implement JsonSerializable for SimpleXMLElement as a Decorator
 *
 * @link https://hakre.wordpress.com/2013/07/09/simplexml-and-json-encode-in-php-part-i
 */
class JsonSimpleXMLElementDecorator implements JsonSerializable
{
    const DEF_DEPTH = 512;

    /**
     * @var SimpleXMLElement
     */
    private $subject;

    private $options = ['@attributes' => true, '@text' => true, 'depth' => self::DEF_DEPTH];

    public function __construct(SimpleXMLElement $element, $useAttributes = true, $useText = true, $depth = self::DEF_DEPTH)
    {
        $this->subject = $element;

        if (! is_null($useAttributes)) {
            $this->useAttributes($useAttributes);
        }
        if (! is_null($useText)) {
            $this->useText($useText);
        }
        if (! is_null($depth)) {
            $this->setDepth($depth);
        }
    }

    public function useAttributes($bool)
    {
        $this->options['@attributes'] = (bool) $bool;
    }

    public function useText($bool)
    {
        $this->options['@text'] = (bool) $bool;
    }

    public function setDepth($depth)
    {
        $this->options['depth'] = (int) max(0, $depth);
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return mixed data which can be serialized by json_encode.
     */
    public function jsonSerialize()
    {
        $subject = $this->subject;

        $array = [];

        // json encode attributes if any.
        if ($this->options['@attributes']) {
            if ($attributes = $subject->attributes()) {
                $array['@attributes'] = array_map('strval', iterator_to_array($attributes));
            }
        }

        // traverse into children if applicable
        $children = $subject;
        $this->options = (array) $this->options;
        $depth = $this->options['depth'] - 1;
        if ($depth <= 0) {
            $children = [];
        }

        // json encode child elements if any. group on duplicate names as an array.
        foreach ($children as $name => $element) {
            /* @var SimpleXMLElement $element */
            $decorator = new self($element);
            $decorator->options = ['depth' => $depth] + $this->options;

            if (isset($array[$name])) {
                if (! is_array($array[$name])) {
                    $array[$name] = [$array[$name]];
                }
                $array[$name][] = $decorator;
            } else {
                $array[$name] = $decorator;
            }
        }

        // json encode non-whitespace element simplexml text values.
        $text = trim($subject);
        if (strlen($text)) {
            if ($array) {
                $this->options['@text'] && $array['@text'] = $text;
            } else {
                $array = $text;
            }
        }

        // return empty elements as NULL (self-closing or empty tags)
        if (! $array) {
            $array = null;
        }

        return $array;
    }
}
