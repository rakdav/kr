<?php

namespace objects;

class Category
{
    // соединение с БД и таблицей "categories"
    private $conn;
    private $table_name = "category";

    // свойства объекта
    public $category_id;
    public $category_name;
    public $description;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT
                category_id, category_name, description,created
            FROM
                " . $this->table_name . "
            ORDER BY
                category_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}