<?php
class GalleryModel
{
    private $conn;

    function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả ảnh theo sản phẩm (dùng cho admin)
    function getAllByProduct($product_id)
    {
        $product_id = (int)$product_id;
        $sql = "SELECT * FROM gallery WHERE product_id = $product_id ORDER BY sort_order, id DESC";
        return $this->conn->query($sql);
    }

    // Lấy tất cả ảnh trong hệ thống (dùng cho trang quản lý chung nếu cần)
    function getAll()
    {
        $sql = "SELECT g.*, p.title AS product_title 
                FROM gallery g 
                LEFT JOIN product p ON g.product_id = p.id 
                ORDER BY g.id DESC";
        return $this->conn->query($sql);
    }

    // Thêm ảnh mới
    function insert($product_id, $image_path, $sort_order = 0)
    {
        $product_id = (int)$product_id;
        $sort_order = (int)$sort_order;
        $image_path = $this->conn->real_escape_string($image_path);
        
        $sql = "INSERT INTO gallery (product_id, image_path, sort_order) 
                VALUES ($product_id, '$image_path', $sort_order)";
        return $this->conn->query($sql);
    }

    // Xóa ảnh
    function delete($id)
    {
        $id = (int)$id;
        // Lấy đường dẫn để xóa file thật
        $sql_path = "SELECT image_path FROM gallery WHERE id = $id";
        $result = $this->conn->query($sql_path);
        if ($row = $result->fetch_assoc()) {
            $path = $row['image_path'];
            if (file_exists($path)) unlink($path);
        }
        
        $sql = "DELETE FROM gallery WHERE id = $id";
        return $this->conn->query($sql);
    }
}