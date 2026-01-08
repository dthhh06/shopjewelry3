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
        $sql = "
        SELECT 
            p.*,
            c.name AS category_name,
            COALESCE(SUM(id.amount), 0) AS total_imported,
            COALESCE(SUM(od.num), 0) AS total_sold
        FROM product p
        LEFT JOIN category c ON p.category_id = c.id
        LEFT JOIN importdetail id ON p.id = id.product_id AND id.isDeleted = 0
        LEFT JOIN orderdetail od ON p.id = od.product_id
        LEFT JOIN `order` o ON od.order_id = o.id 
            AND o.isDeleted = 0 
            AND o.status = 1  -- Chỉ tính đơn đã duyệt (đã giao hoặc hoàn thành)
        GROUP BY p.id
        ORDER BY p.id DESC
    ";

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
     //   $price      = (int)$data['price'];
        $category   = (int)$data['category_id'];
      //  $discount   = (int)$data['discount'];
        $thumbnail  = $this->conn->real_escape_string($data['thumbnail']);
        $image1     = $this->conn->real_escape_string($data['image1']);
        $image2     = $this->conn->real_escape_string($data['image2']);
        $desc       = $this->conn->real_escape_string($data['description']);
    //    $quantity   = (int)$data['quantity'];

        $sql = "UPDATE product 
                SET title='$title',
                    category_id=$category,
                    thumbnail='$thumbnail',
                    image1='$image1',
                    image2='$image2',
                    description='$desc',
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
//     function updatePriceAndStock($product_id, $sale_price, $discount, $amount, $import_price = 0)
//     {
//         $product_id   = (int)$product_id;
//         $sale_price   = (int)$sale_price;
//         $discount     = (int)$discount;
//         $amount       = (int)$amount;
//         $import_price = (int)$import_price;

//         if ($sale_price <= 0 || $amount <= 0) {
//             return false;
//         }

//         $final_price = $sale_price * (100 - $discount) / 100;

//         if ($import_price > 0 && $import_price >= $final_price) {
//             return false;
//         }

//         $sql = "UPDATE product 
//                 SET price = $sale_price,
//                     discount = $discount,
//                     quantity = quantity + $amount
//                 WHERE id = $product_id";

//         return $this->conn->query($sql);
//     }

