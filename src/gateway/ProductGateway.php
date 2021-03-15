<?php

namespace Src\Gateway;

use Src\Model\Product;
use Src\Model\Price;

class productGateway
{
    private $products = null;

    public function __construct()
    {
        $products = json_decode(file_get_contents('./src/model/products.json'));
        $this->products = $products;
    }

    public function filterProducts($category, $priceLess)
    {
        $array = $this->transform();
        if (null == $priceLess) {
            $filtered = array_filter($array, function ($item) {
                $class = new Product();
                $class->setData($item);
                return $class->getCategory() == $_GET['category'] ? true : false;
            });
        } elseif (null == $category) {
            $filtered = array_filter($array, function ($item) {
                $class = new Product();
                $class->setData($item);
                return $class->getPrice()->getOriginal() < $_GET['priceLessThan'] ? true : false;
            });
        } else {
            $filtered = array_filter($array, function ($item) {
                $class = new Product();
                $class->setData($item);
                return ($class->getPrice()->getOriginal() < $_GET['priceLessThan']) && ($class->getCategory() == $_GET['category']) ? true : false;
            });
        }


        return $filtered;
    }

    public function transform()
    {
        $in = $this->products->products;
        $out = array();
        foreach ($in as $valor) {
            $productTemp = new Product();
            $priceTemp = new Price();
            $productTemp->setSku($valor->sku);
            $productTemp->setName($valor->name);
            if ($valor->category == "boots") {
                $priceTemp->setDiscountPercentage("30%");
                $priceTemp->setFinal(round(0.70 * $valor->price));
            }
            if ($valor->sku == "000003") {
                $priceTemp->setDiscountPercentage("15%");
                $priceTemp->setFinal(round(0.85 * $valor->price));
            }
            if (null == $priceTemp->getDiscountPercentage()) {
                $priceTemp->setFinal($valor->price);
            }
            $productTemp->setCategory($valor->category);
            $priceTemp->setOriginal($valor->price);
            $productTemp->setPrice($priceTemp);
            array_push($out, $productTemp);
        }
        return $out;
    }
}
