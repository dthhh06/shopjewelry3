<?php
class ProductModel
{
    public $conn;

    function __construct($db)
    {
        $this->conn = $db;
    }

    function getAll()
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id";
        return $this->conn->query($sql);
    }

    function getById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM product WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    function insert($data)
    {

        $title      = $this->conn->real_escape_string($data['title']);
        $price      = (int)$data['price'];
        $category   = (int)$data['category_id'];
        $discount   = (int)$data['discount'];
        $thumbnail  = $this->conn->real_escape_string($data['thumbnail']);
        $image1     = $this->conn->real_escape_string($data['image1']);
        $image2     = $this->conn->real_escape_string($data['image2']);
        $desc       = $this->conn->real_escape_string($data['description']);
        $quantity   = (int)$data['quantity'];

        $sql = "INSERT INTO product 
                    (title, price, category_id, discount, thumbnail, image1, image2, description, quantity)
                VALUES 
                    ('$title', $price, $category, $discount, '$thumbnail', '$image1', '$image2', '$desc', $quantity)";

        return $this->conn->query($sql);
    }

    function update($id, $data)
    {

        $id         = (int)$id;
        $title      = $this->conn->real_escape_string($data['title']);
        $price      = (int)$data['price'];
        $category   = (int)$data['category_id'];
        $discount   = (int)$data['discount'];
        $thumbnail  = $this->conn->real_escape_string($data['thumbnail']);
        $image1     = $this->conn->real_escape_string($data['image1']);
        $image2     = $this->conn->real_escape_string($data['image2']);
        $desc       = $this->conn->real_escape_string($data['description']);
        $quantity   = (int)$data['quantity'];

        $sql = "UPDATE product 
                SET title='$title',
                    price=$price,
                    category_id=$category,
                    discount=$discount,
                    thumbnail='$thumbnail',
                    image1='$image1',
                    image2='$image2',
                    description='$desc',
                    quantity=$quantity
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    function delete($id)
    {
        $id = (int)$id;

        $this->conn->query("DELETE FROM importdetail WHERE product_id = $id");

        return $this->conn->query("DELETE FROM product WHERE id = $id");
    }
}
