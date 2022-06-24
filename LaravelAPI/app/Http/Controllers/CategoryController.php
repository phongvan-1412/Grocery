<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Laravie\Parser\Xml\Reader;
use Laravie\Parser\Xml\Document;
use Spatie\ArrayToXml\ArrayToXml;
use Bmatovu\LaravelXml\Support\XMLElement;
use FetchLeo\LaravelXml\Contracts\Converter;
use SimpleXMLElement;
use FetchLeo\LaravelXml\Exceptions\CantConvertValueException;

class CategoryController extends Controller
{
    
}
