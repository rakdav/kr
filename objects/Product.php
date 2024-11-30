<?php

namespace objects;

class Product
{
    private $conn;
    private $table_name = 'product';
    public $product_id;
    public $product_name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;
    public function __construct($db){
        $this->conn = $db;
    }
    public function read()
    {
        $query="select c.category_name,p.product_id,p.product_name,p.description,c.category_id,
	            p.price,p.created from ".$this->table_name." p left join category c 
                on p.category_id = c.category_id 
                order by p.created desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function create(){
        $query="insert into ".$this->table_name." (category_id,product_name,description,price,created) 
        values (:category_id,:product_name,:description,:price,:created)";
        $stmt = $this->conn->prepare($query);
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $stmt->bindParam(':category_id',$this->category_id);
        $stmt->bindParam(':product_name',$this->product_name);
        $stmt->bindParam(':description',$this->description);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':created',$this->created);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}