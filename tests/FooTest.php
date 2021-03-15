<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase as TestCase;


class BuiltinTest extends TestCase
{


    public function testCurl()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/myTheresa/products.php?priceLessThan=72000");



        $ch = curl_init();
        $this->assertEquals('{"2":{"sku":"000003","name":"Ashlington leather ankle boots","category":"boots","price":{"original":71000,"final":60350,"discountPercentage":"15%","currency":"EUR"}},"4":{"sku":"000005","name":"Nathane leather sneakers","category":"sneakers","price":{"original":59000,"final":59000,"discountPercentage":null,"currency":"EUR"}}}', curl_exec($ch));
        curl_close($ch);
    }
}
