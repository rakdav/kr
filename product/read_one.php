<?php
use objects\Product;

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    include_once '../config/database.php';
    include_once '../objects/Product.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    $product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
    $product->readOne();
    if($product->product_name!=null){
        $product_arr = array
        (
            "product_id" => $product->product_id,
            "product_name" => $product->product_name,
            "price" => $product->price,
            "category_id" => $product->category_id,
            "category_name" => $product->category_name,
            "description" => $product->description,
        );
        http_response_code(200);
        echo json_encode($product_arr);
    }
    else
    {
        http_response_code(404);
        echo json_encode(array("message" => "Товар не существует."),
            JSON_UNESCAPED_UNICODE);
    }
