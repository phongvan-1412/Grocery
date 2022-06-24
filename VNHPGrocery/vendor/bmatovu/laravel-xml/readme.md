## Laravel XML Support Package

[![Total Downloads](https://poser.pugx.org/bmatovu/laravel-xml/downloads)](https://packagist.org/packages/bmatovu/laravel-xml)
[![Latest Stable Version](https://poser.pugx.org/bmatovu/laravel-xml/v/stable)](https://packagist.org/packages/bmatovu/laravel-xml)
[![License](https://poser.pugx.org/bmatovu/laravel-xml/license)](https://packagist.org/packages/bmatovu/laravel-xml)

This package comes with the much desired xml support for you Laravel project including middleware to accept only xml requests, 
http response in xml, and more utilities for xml conversions as well as validation.

**Supports:** Laravel versions from v5.3 up to v7.0

### Installation

```bash
$ composer require bmatovu/laravel-xml
```

### Requests

Get the request content (body).

```php
$request->xml();
```

\* Returns `Bmatovu\LaravelXml\Support\XMLElement` object.

Determine if the request content type is XML.

```php
$request->isXml();
```

Determine if the current request is accepting XML.

```php
$request->wantsXml();
```

Validate XML content

```php
Xml::is_valid($request->xml());
```

**Validation** - Against XML Schema Definition
```php
$errors = Xml::validate($request->xml(), 'path_to/sample.xsd');

if ($errors) {
    return response()->xml(['error' => $errors], 422);
}
```

### Responses

Expects an array, convent you're objects to arrays prior...

```php
Route::get('/users', function () {
    $users = App\User::all();
    return response()->xml(['users' => $users->toArray()]);
});
```

Sample response from above snippet

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <users>
        <id>1</id>
        <name>John Doe</name>
        <email>jdoe@example.com</email>
        <created_at>2018-07-12 17:06:13</created_at>
        <updated_at>2018-07-12 18:00:05</updated_at>
    </users>
    <users>
        <id>2</id>
        <name>Gary Plant</name>
        <email>gplant@example.com</email>
        <created_at>2018-07-12 18:02:26</created_at>
        <updated_at>2018-07-13 11:22:44</updated_at>
    </users>
</document>
```

And will automatically set the content type to xml

`Content-Type → text/xml; charset=UTF-8`

### Middleware

First register the middleware in `app\Http\Kernel.php`

```php
protected $routeMiddleware = [
    // ...
    'xml' => \Bmatovu\LaravelXml\Http\Middleware\RequireXml::class,
];
```

Then use the middleware on your routes, or in the controllers. 

```php
Route::post('/user/store', function (Request, $request) {
    // do something...
})->middleware('xml');
```

In case of the request `content-type` is not xml, the response will be; 

[`415` - **Unsupported Media Type**]

```xml
<?xml version="1.0" encoding="UTF-8"?>
<document>
    <error>Only accepting xml content</error>
</document>
```

### Utilities

**Encode: Array to Xml**

```php
Xml::encode(['key' => 'value']);
```

Or

```php
xml_encode(['key' => 'value']);
```


**Decode: Xml to Array**

```php
Xml::decode('<?xml version="1.0" encoding="UTF-8"?><document><key>value</key></document>');
```

Or

```php
xml_decode('<?xml version="1.0" encoding="UTF-8"?><document><key>value</key></document>');
```

<hr/>

Credits
---
Under the hood, I'm using;

[Spatie's array to XML convernsion](https://github.com/spatie/array-to-xml)

[Hakre's XML to JSON conversion](https://hakre.wordpress.com/2013/07/09/simplexml-and-json-encode-in-php-part-i)

[Akande's XML validation](https://medium.com/@Sirolad/validating-xml-against-xsd-in-php-5607f725955a)

Reporting bugs
--
If you've stumbled across a bug, please help us by leaving as much information about the bug as possible, e.g.

- Steps to reproduce
- Expected result
- Actual result

This will help us to fix the bug as quickly as possible, and if you do wish to fix it yourself; 
feel free to [fork the package on GitHub](https://github.com/mtvbrianking/laravel-xml) and submit a pull request!
