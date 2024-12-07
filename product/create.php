<?php

use objects\Product;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../objects/product.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    $data = json_decode(file_get_contents("php://input"));
//    echo $data->product_name;
////    echo $data->description;
//    echo $data->price;
//    echo $data->category_id;
    if(!empty($data->product_name)&&!empty($data->description)
        &&!empty($data->price)&&!empty($data->category_id)) {
        $product->product_name = $data->product_name;
        $product->description = $data->description;
        $product->price = $data->price;
        $product->category_id = $data->category_id;
        $product->created = date("Y-m-d H:i:s");

        if ($product->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Товар был создан."),
                JSON_UNESCAPED_UNICODE);
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно создать товар."),
            JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно создать товар.Данные неполные",JSON_UNESCAPED_UNICODE));
    }