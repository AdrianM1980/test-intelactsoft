<?php
namespace Mtest\Controllers;
use Mtest\App\AppController;
use Mtest\Models\ProductModel;

//require_once './App/AppController.php';

class ProductController extends AppController{
    
    
    public function saveProduct($productData = []){
      
        if(!empty($productData)){
            foreach($productData as $product){
                $id = !empty($product['id']) ? $product['id'] : '';
                $category = !empty($product['category']) ? $product['category'] : '';
                $description = !empty($product['description']) ? $product['description'] : '';
                $price = !empty($product['price']) ? $product['price'] : '';
                $productModel = new ProductModel(); 
                $productModel->setId($id);
                $productModel->setCategory($category);
                $productModel->setDescription($description);
                $productModel->setPrice($price);
                $productModel->save();
            }
        }
    }

    
}

?>
