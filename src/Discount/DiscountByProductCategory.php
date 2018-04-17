<?php
namespace Mtest\Discount\DiscountByProductCategory;
use Mtest\Discount\DiscountAbstract;
use Mtest\Models\ProductModel;

class DiscountByProductCategory extends DiscountAbstract{
    
    private $applyDiscount = false;
    private $order;
    private $discountValue;
    
    public function checkIfApplyDiscount(){
        
        $productModel = new ProductModel();
        
       
    }
    
    public function calculateDiscount(){
       
        if($this->applyDiscount){
            
        }
    }
    
    public function discountMessage(){
        
    }
}