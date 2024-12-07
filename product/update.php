<?php
use objects\Product;
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, 
    Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/Product.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    $data = json_decode(file_get_contents("php://input"));
    $product->product_id = $data->product_id;
    $product->product_name = $data->product_name;
    $product->category_id = $data->category_id;
    $product->description = $data->description;
    $product->price = $data->price;