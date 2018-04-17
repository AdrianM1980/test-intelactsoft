<?php
namespace Mtest\Discount;
use Mtest\Discount\DiscountAbstract;
use Mtest\Models\ProductModel;

class DiscountNumberOfProducts extends DiscountAbstract{
    private $applyDiscount = false;
    private $order;
    const CATEGORY_ID = 2;
    const CATEGORY_NAME = 'Switches';
    const NR_OF_PRODUCTS_FOR_DISCOUNT = 5;
    private $discount = [];
    private $applyDiscountForProducts = [];
    
    public function checkIfApplyDiscount(){
        
        $this->order = $this->getOrder();
        $productOrderIds = $this->getOrderProductsEqualWithQuantity(self::NR_OF_PRODUCTS_FOR_DISCOUNT);
          
        $productModel = new ProductModel();
        $this->applyDiscountForProducts = $productModel->getProductsByIdsAndCategoryId($productOrderIds, self::CATEGORY_ID);
      
        if(!empty($this->applyDiscountForProducts)){
            $this->applyDiscount = true;
        }    
    
        return $this->applyDiscount;
    }
    
    /**
     * Nothing to calculate for this discount.
     */
    public function calculateDiscount(){
       
     if(!empty($this->applyDiscount)){
         foreach($this->applyDiscountForProducts as $product){
             $this->discount[$product['id']] = [
                 'quantity_discount' => 6 
             ];
         }
     }
     
     return $this->discount;
    }
    
    public function discountMessage(){
        
        $message = '';
        if($this->applyDiscount){
            $message =  'For every product of category "'.self::CATEGORY_NAME .'" , when you buy '. self::NR_OF_PRODUCTS_FOR_DISCOUNT .  ', you get a sixth for free';        
        }
        
        return $message;
    }
}

