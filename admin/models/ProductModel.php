<?php
class ProductModel {
    public $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getAll() {
        $sql = "SELECT p.*, c.name AS category_name
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.deleted = 0";
        return $this->conn->query($sql);
    }

    function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM product WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    function insert($data) {
        $title      = $this->conn->real_escape_string($data['title']);
        $price      = (int)$data['price'];
        $category   = (int)$data['category_id'];
        $discount   = (int)$data['discount'];
        $thumbnail  = $this->conn->real_escape_string($data['thumbnail']);
        $desc       = $this->conn->real_escape_string($data['description']);
        $quantity   = (int)$data['quantity'];

        $sql = "INSERT INTO product (title, price, category_id, discount, thumbnail, description, quantity)
                VALUES ('$title', $price, $category, $discount, '$thumbnail', '$desc', $quantity)";
        return $this->conn->query($sql);
    }

    function update($id, $data) {
        $id         = (int)$id;
        $title      = $this->conn->real_escape_string($data['title']);
        $price      = (int)$data['price'];
        $category   = (int)$data['category_id'];
        $discount   = (int)$data['discount'];
        $thumbnail  = $this->conn->real_escape_string($data['thumbnail']);
        $desc       = $this->conn->real_escape_string($data['description']);
        $quantity   = (int)$data['quantity'];

        $sql = "UPDATE product 
                SET title='$title', price=$price, category_id=$category, discount=$discount,
                    thumbnail='$thumbnail', description='$desc', quantity=$quantity
                WHERE id = $id";
        return $this->conn->query($sql);
    }

    function softDelete($id) {
        $id = (int)$id;
        $sql = "UPDATE product SET deleted = 1 WHERE id = $id";
        return $this->conn->query($sql);
    }
}
