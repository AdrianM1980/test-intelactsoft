<?php

namespace Mtest\Discount;

abstract class DiscountAbstract{

    private $order;
    
    function __construct($order) {       
        $this->order = $order;
    }
    
    public function getOrder() {       
       return $this->order;
    }
    
    function getOrderProductsIds(){
        
        $orderProductsIds = [];
        if(!empty( $this->order['items'])){
            foreach($this->order['items'] as $orderItem){                   
                $orderProductsIds[] = $orderItem['product-id'];            
            }
        }
     
        return $orderProductsIds;
    }
    
    abstract function checkIfApplyDiscount();
    abstract function calculateDiscount();
    abstract function discountMessage();

}
