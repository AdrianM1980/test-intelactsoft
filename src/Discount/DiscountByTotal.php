<?php

namespace Mtest\Discount;
use Mtest\Discount\DiscountAbstract;

class DiscountByTotal extends DiscountAbstract{
    
    private $applyDiscount = false;
    private $order;
    private $discount;
    
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
            $discount = ($this->order['total'] * self::DISCOUNT_PERCENATGE) / 100;
            
            $this->discount['total_order'] = ['discount_order' => number_format($discount,2)];
                               
                                
        }
        
        return $this->discount;
    }

    public function discountMessage(){
        
         $message = '';
         if($this->applyDiscount)
         {
            $message =  "Because your order cost is over than ".self::MIN_VALUE_FOR_DISCOUNT." you have ".self::DISCOUNT_PERCENATGE."% discount from order.";
            $message.= " You get  ".$this->discountValue ." discount.";
         }
         return $message;
     }       
}