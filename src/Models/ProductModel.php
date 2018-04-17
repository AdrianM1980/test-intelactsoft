<?php
namespace Mtest\Models;
use Mtest\App\AppModel;
use Mtest\Db\DbCon;

//require_once './src/Db/DbCon.php';

class ProductModel extends AppModel{
    
    private $id;
    private $description ='áa';
    private $category; 
    private $price;         
 
    
    function save(){

        $stmt = DbCon::con()->prepare("INSERT INTO products (id, description, category, price) VALUES (:id, :description, :category, :price )");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':price', $this->price);
        
        try{
            $stmt->execute();
        } catch (PDOException $e){
            var_dump($e->getMessage());
        }
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setDescription($description){
        $this->description = $description;
    }
    
    public function setCategory($category){
        $this->category = $category;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }
    
    public function getProductsByIdsAndCategoryId($productsIds, $categoryId): array{
        
        $products = [];
        if(
            empty($productsIds) && 
            empty($categoryId)
        ){
            return $products;
        }
        
        $productsIdClause = implode(',', array_fill(0, count($productsIds), '?'));
        $query = "SELECT id, category, price FROM products WHERE  category = ? AND  id IN($productsIdClause) ";        
        $sth = DbCon::con()->prepare($query);  
        $queryParams = array_merge([$categoryId], $productsIds);
        $sth->execute($queryParams);
        $products =  $sth->fetchAll(\PDO::FETCH_ASSOC);
        
        return $products;
    }
}