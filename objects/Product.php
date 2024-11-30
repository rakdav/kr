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
}