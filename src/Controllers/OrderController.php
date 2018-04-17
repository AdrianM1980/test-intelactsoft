<?php
namespace Mtest\Controllers;
use Mtest\App\AppController;
use Mtest\Models\OrderModel;
use Mtest\Models\ProductModel;
use Mtest\Discount;

class OrderController extends AppController{
    
    private $discountByTotalMessages = [];
   
    
    public function getDiscountsForOrder($orderData = []){
       
        //check for discount
        $discountByTotalObj = new  Discount\DiscountByTotal($orderData);
        $applyDiscountByTotal = $discountByTotalObj->checkIfApplyDiscount();
      
        if(!empty($applyDiscountByTotal)){
            $discountByTotalObj->calculateDiscount();            
            $this->discountByTotalMessages[] =  $discountByTotalObj->discountMessage();
        }
     
        $discountByCategory = new Discount\DiscountNumberOfProducts($orderData);
        $applyDiscountByCategory = $discountByCategory->checkIfApplyDiscount();
        if($discountByCategory){
            echo 'áaa';
           $this->discountByTotalMessages[] = $discountByCategory->discountMessage();
        }
     
        var_dump($this->discountByTotalMessages);
    } 
    
}

?>
