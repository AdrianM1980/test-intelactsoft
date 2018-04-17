<?php
namespace Mtest\Discount;
use Mtest\Discount\DiscountAbstract;
use Mtest\Models\ProductModel;

class DiscountByProductCategory extends DiscountAbstract{
    
    const CATEGORY_ID = 1;
    const CATEGORY_NAME = 'Tools';
    const DISCOUNT_PERCENTAGE = 20;
    
    private $applyDiscount = false;
    private $order;
    const MIN_NR_OF_PRODUCTS_FOR_DISCOUNT = 2;
    private $discount = [];
    private $applyDiscountForProduct = [];
    
    
    public function checkIfApplyDiscount(){
        
        $this->order = $this->getOrder();
        $productOrderIds = $this->getOrderProductsIds();
        
        $productModel = new ProductModel();
        $products = $productModel->getProductsByIdsAndCategoryId($productOrderIds, self::CATEGORY_ID);          
        //get the chepeast product
        $cheapestProductFromOrder = [];
        if(count($products)> 1){
            foreach($products as $product){
                foreach($this->order['items'] as $item){
                     if($product['id'] === $item['product-id']){
                         
                         if(empty($cheapestProductFromOrder)){
                             $cheapestProductFromOrder = $item;
                         }else{
                             if($cheapestProductFromOrder['unit-price'] > $item['unit-price']){
                                 $cheapestProductFromOrder = $item;
                             }
                         }
                     }
                }
            }
        }else if(count($products)==1){
          
            foreach($products as $product){
                foreach($this->order['items'] as $item){
                     if($product['id'] === $item['product-id']){  
                        if($item['quantity'] > 1){
                            $cheapestProductFromOrder = $item;
                        }
                     }
                }
            }
        }
        
        $this->applyDiscountForProduct = $cheapestProductFromOrder;
    
        if(!empty($this->applyDiscountForProduct)){
            $this->applyDiscount = true;
        }
       
       return  $this->applyDiscount;
    }
    
    public function calculateDiscount(){
      
        if($this->applyDiscount){
            if(!empty($this->applyDiscountForProduct)){
                $discount = ($this->applyDiscountForProduct['unit-price'] * self::DISCOUNT_PERCENTAGE) / 100;
                $product = $this->applyDiscountForProduct;
                 $this->discount[$this->applyDiscountForProduct['product-id']] = [
                                                                                    'discount_product_price' => number_format($discount, 2)
                                                                                   ];
            }
        }
        
        return $this->discount;
    }
    
    public function discountMessage(){
        
        $message = '';
        if($this->applyDiscount){
            $message = 'Because you have buy at least ' . self::MIN_NR_OF_PRODUCTS_FOR_DISCOUNT . ' products ';
            $message .= 'from category ' . self::CATEGORY_NAME . ' you get a '.self::DISCOUNT_PERCENTAGE.'% discount';
            $message .= 'of the product '. $this->applyDiscountForProduct['product-id'];
        }
        return $message;
        
    }
}