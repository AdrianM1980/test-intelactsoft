<?php
use Mtest\Controllers\OrderController;
use Mtest\Controllers\ProductController;
use Mtest\Models;



//include autoload file
require_once  './vendor/autoload.php';

$app = Base::instance();

$orderController = new OrderController();
$productController = new ProductController();



$app->route('POST /save-product',
    function($app, $params) use ($productController){
        $productJson = trim(file_get_contents("php://input"));
        $jsonProductDecoded = json_decode($productJson, true);
        $productController->saveProduct($jsonProductDecoded);
    }
);

$app->route('GET|POST /get-order-discounts',
    function($app, $params) use ($orderController){
        $jsonOrder = trim(file_get_contents("php://input"));
        $jsonOrderDecoded = json_decode($jsonOrder, true);
        $orderController->getDiscountsForOrder($jsonOrderDecoded);
    }
);
        
 $app->run();