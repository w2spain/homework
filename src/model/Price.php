<?php

namespace Src\Model;

class Price implements \JsonSerializable
{
    private $original;
    private $final;
    private $discountPercentage;
    private $currency;

    public function __construct($original = null, $final = null, $discountPercentage = null, $currency = "EUR")
    {
        $this->original = $original;
        $this->final = $final;
        $this->discountPercentage = $discountPercentage;
        $this->currency = $currency;
    }

    public function setOriginal($original)
    {
        $this->original = $original;
    }

    public function getOriginal()
    {
        return $this->original;
    }

    public function setFinal($final)
    {
        $this->final = $final;
    }

    public function getFinal()
    {
        return $this->final;
    }

    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
    }

    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function jsonSerialize()
    {
        return [
            'original' => $this->original,
            'final' => $this->final,
            'discountPercentage' => $this->discountPercentage,
            'currency' => $this->currency,
        ];
    }
}
