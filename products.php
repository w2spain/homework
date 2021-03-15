<?php
include './src/controller/ProductController.php';

use Src\Controller\ProductController;

header("Content-Type: application/json; charset=UTF-8");

$requestMethod = $_SERVER['REQUEST_METHOD'];
$controller = new ProductController($requestMethod);

$controller->processRequest();
