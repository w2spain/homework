<?php

namespace Src\Controller;

include './src/gateway/ProductGateway.php';
include './src/model/Price.php';
include './src/model/Product.php';

use Src\Gateway\ProductGateway;

class ProductController
{

    private $requestMethod;
    private $productGateway;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->productGateway = new ProductGateway();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':

                if (isset($_GET['category']) && isset($_GET['priceLessThan'])) {
                    $response = $this->getFilteredProducts($_GET['category'], $_GET['priceLessThan']);
                } elseif (isset($_GET['category'])) {
                    $response = $this->getFilteredProducts($_GET['category']);
                } elseif (isset($_GET['priceLessThan'])) {
                    $response = $this->getFilteredProducts(null, $_GET['priceLessThan']);
                } elseif (!$_GET) {
                    $response = $this->getAll();
                } else {
                    $response = $this->unprocessableEntityResponse();
                }

                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAll()
    {
        $result = $this->productGateway->transform();
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }


    private function getFilteredProducts($category = null, $priceLess = null)
    {
        $result = $this->productGateway->filterProducts($category, $priceLess);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }


    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => "Invalid input"
        ]);

        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 200 Not Found';
        $response['body'] = json_encode([
            'error' => 'No results found'
        ]);
        return $response;
    }
}
