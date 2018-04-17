<?php
namespace Mtest\Controllers;
use Mtest\App\AppController;
use Mtest\Models\OrderModel;
use Mtest\Models\ProductModel;
use Mtest\Discount;

class OrderController extends AppController{
    
    private $orderDiscounts = [];
   
    
    public function getDiscountsForOrder($orderData = []){
       
        //check for discount
        $discountByTotalObj = new  Discount\DiscountByTotal($orderData);
        $applyDiscountByTotal = $discountByTotalObj->checkIfApplyDiscount();
      
        if(!empty($applyDiscountByTotal)){
            $discount = $discountByTotalObj->calculateDiscount();
            
            $this->orderDiscounts[] =[
                'discount' => $discount,
                'discount-message' =>  $discountByTotalObj->discountMessage()
            ];                    
        }
     
        $discountNumberOfProducts = new Discount\DiscountNumberOfProducts($orderData);
        $applyDiscountNumberOfProducts = $discountNumberOfProducts->checkIfApplyDiscount();
        if($applyDiscountNumberOfProducts){
            $discount =  $discountNumberOfProducts->calculateDiscount(); 
            $this->orderDiscounts[] =[
                'discount' => $discount,
                'discount-message' =>  $discountNumberOfProducts->discountMessage()
            ];           
        }
        
        $discountByProductCategory = new Discount\DiscountByProductCategory($orderData);
        $applyByProductCategory = $discountByProductCategory->checkIfApplyDiscount();
       
        if($applyByProductCategory){
             $discount =  $discountByProductCategory->calculateDiscount();
             $this->orderDiscounts[] =[
                'discount' => $discount,
                'discount-message' =>  $discountByProductCategory->discountMessage()
            ];
        }
   
        //var_dump($this->orderDiscounts);
        
        if(empty($this->orderDiscounts)){
            $this->orderDiscounts[] = [
                'discount' => null,
                'discount-message' => 'There is no discount for this order'
            ];
        }
        
        echo json_encode($this->orderDiscounts);
        
        return true;
    } 
    
}

?>
