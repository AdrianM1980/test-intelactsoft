<?php
namespace Mtest\Models;
use Mtest\App\AppModel;
use Mtest\Discount\DiscountByCategory;
use Mtest\Discount\DiscountByProductCategory;
use Mtest\Discount\DiscountByTotal;

class OrderModel extends AppModel{
    
    private $orderData = [];
    
    function __construct($data) {
       $this->orderData = $data;
    }
    
    function saveModel(){
        
        var_dump($this->data);
    }
}