<?php

namespace Src\Model;

class Product implements \JsonSerializable
{
    private $sku;
    private $name;
    private $category;
    private $price;

    public function __construct($sku = null, $name = null, $category = null, $price = null)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setPrice(Price $price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function jsonSerialize()
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,

        ];
    }

    public function setData($data)
    {
        $this->sku = $data->sku;
        $this->name = $data->name;
        $this->category = $data->category;
        $this->price = $data->price;
    }
}
