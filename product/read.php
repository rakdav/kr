<?php

use objects\Product;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../objects/product.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    $stmt=$product->read();
    $num = $stmt->rowCount();
    if($num>0){
        $product_arr=array();
        $product_arr["records"]=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item=array(
                "product_id"=>$product_id,
                "product_name"=>$product_name,
                "price"=>$price,
                "category_id"=>$category_id,
                "description"=>$description,
                "created"=>$created
            );
            $product_arr["records"][] = $product_item;
        }
        http_response_code(200);
        echo json_encode($product_arr);
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Товары не найдены."),
            JSON_UNESCAPED_UNICODE);
    }