# Generate Pragma import XML 

[![Latest Version on Packagist](Https://img.shields.io/packagist/v/vladelio/pragmaxmlgenerator.svg)](https://gitlab.com/Vladelis/laravel-pragma-xml-generator/tags)
[![Total Downloads](https://img.shields.io/packagist/dt/vladelio/pragmaxmlgenerator.svg)](https://packagist.org/packages/vladelio/pragmaxmlgenerator)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

A package for Laravel 5.8 to generate importable XML of invoices into Pragma accounting system.

## Installation

Via Composer

``` bash
$ composer require vladelio/pragmaxmlgenerator
```

Don't forget to vendor publish the config file and edit it so it fits your information

``` bash
$ php artisan vendor:publish
```

## Usage

Init the XML file

```php
PragmaXmlGenerator::init($fileId);
```

This initializes an empty Pragma invoice XML document

Next add an empty invoice with it's id, date, VAT %, currency ISO code, buyer name, email and optionally address parameters.

```php
PragmaXmlGenerator::buildInvoice('1', '2019-09-09', 21, 'EUR', 'Full Name', 'email@email.email');
```

This adds a pending invoice (not yet rendered in XML)

Next add items to the pending invoice with the item number, product id, description, price and quantity.

```php
PragmaXmlGenerator::addItem('Item Number', 'Product Id', 'Description', 9.99, 1);
```

When you're done adding items, commit the pending invoice to the XML.

```php
PragmaXmlGenerator::commitInvoice();
```

And lastly when you're done adding invoices generate the XML.

```php
$xml = PragmaXmlGenerator::generateXML();
```

This returns the XML.

## Testing

No tests have been added, feel free to contribute.

``` bash
$ composer test
```

## Credits

- [Vladelis](https://gitlab.com/Vladelis)

## License

Please see the [License](LICENSE) for more information.