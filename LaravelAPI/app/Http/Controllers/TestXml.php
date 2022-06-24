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

class TestXml extends Controller
{
    public function ShowAddCategory()
    {
        $categories = DB::select("exec sp_select_root_category_name");

        $arr = TestXml::AddCollection($categories);


        $xml = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8'?><CategoryInfo/>");

        //loop through the data, and add each record to the xml object
        foreach($arr as $category){
            $category = $xml->addChild('category');
            $category->addChild('category_id',$category->category_id);
            $category->addChild('category_name',$category->category_name);
            $category->addChild('category_root',$category->category_root);
            $category->addChild('category_status',$category->category_status);
        }

        //save the xml file
        $xml->asXML("xml/category.xml");
        return $xml;
    }

    public function AddCollection($arr)
    {
        $collection = collect();

        foreach($arr as $category)
        {
            $newCategory = new Category();
            $newCategory = $category;
            $collection->add($newCategory);
        }

        return $collection;
    }
}
