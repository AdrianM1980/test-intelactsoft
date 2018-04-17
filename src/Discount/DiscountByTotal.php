<?php

namespace Mtest\Discount;
use Mtest\Discount\DiscountAbstract;

class DiscountByTotal extends DiscountAbstract{
    
    private $applyDiscount = false;
    private $order;
    private $discountValue;
    
    const DISCOUNT_PERCENATGE = 10;
    const MIN_VALUE_FOR_DISCOUNT = 1000;
    
    public function checkIfApplyDiscount(){
        
        $this->order = $this->getOrder();
        if($this->order['total'] >self::MIN_VALUE_FOR_DISCOUNT){
            $this->applyDiscount = true;
        }
        
        return $this->applyDiscount;
    }
    
    public function calculateDiscount() {
        
        if($this->applyDiscount){
            $this->discountValue = ($this->order['total'] * self::DISCOUNT_PERCENATGE) / 100;
        }
    }

    public function discountMessage(){
        
         $message = '';
         if($this->applyDiscount)
         {
            $message =  "Because your order cost is over than ".self::MIN_VALUE_FOR_DISCOUNT." you have ".self::DISCOUNT_PERCENATGE."% discount from order."
                . " You get  ".$this->discountValue ." discount. The new value of order is". number_format($this->order['total'] - $this->discountValue, 2);
         }
         
         return $message;
     }       
}