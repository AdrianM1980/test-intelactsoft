<?php
namespace Mtest\Discount;
use Mtest\Discount\DiscountAbstract;
use Mtest\Models\ProductModel;

class DiscountNumberOfProducts extends DiscountAbstract{
    private $applyDiscount = false;
    private $order;
    const CATEGORY_ID = 2;
    const CATEGORY_NAME = 'Switches';
    const NR_OF_PRODUCTS_FOR_DISCOUNT = 1;
    
    public function checkIfApplyDiscount(){
        
        $this->order = $this->getOrder();
        $productOrderIds = $this->getOrderProductsIds();
        $productModel = new ProductModel();
        
        $products = $productModel->getProductsByIdsAndCategoryId($productOrderIds, self::CATEGORY_ID);
     
        if(count($products) > self::NR_OF_PRODUCTS_FOR_DISCOUNT){
            $this->applyDiscount = true;
        }        
    }
    
    /**
     * Nothing to calculate for this discount.
     */
    public function calculateDiscount(){
        
    }
    
    public function discountMessage(){
        
        $message = '';
        if($this->applyDiscount){
            $message = 'You have get a discount because you buy more than '. self::NR_OF_PRODUCTS_FOR_DISCOUNT .  ' products from category ' . self::CATEGORY_NAME;
        }
        
        return $message;
    }
}

