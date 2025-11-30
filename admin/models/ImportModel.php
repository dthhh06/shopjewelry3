<?php
class ImportModel
{
    private $conn;

    function __construct($db)
    {
        $this->conn = $db;
    }

    function getAll()
    {
        $sql = "
        SELECT import.*, 
               supplier.name AS supplier_name,
               user.fullname AS user_name
        FROM import
        JOIN supplier ON supplier.id = import.supplier_id
        JOIN user ON user.id = import.user_id
        WHERE import.isDeleted = 0
        ORDER BY import.id DESC
    ";

        return $this->conn->query($sql);
    }


    function getById($id)
    {
        $sql = "
        SELECT import.*,
               supplier.name AS supplier_name,
               supplier.contact AS supplier_phone,
               supplier.address AS supplier_address,
               user.fullname AS user_name,
               user.email AS user_email,
               user.phone_number AS user_phone
        FROM import
        JOIN supplier ON supplier.id = import.supplier_id
        JOIN user ON user.id = import.user_id
        WHERE import.id = $id
    ";

        return $this->conn->query($sql)->fetch_assoc();
    }


    function insertImport($supplier_id, $user_id)
    {
        $sql = "
            INSERT INTO import (supplier_id, user_id, isDeleted)
            VALUES ($supplier_id, $user_id, 0)
        ";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    function insertImportDetail($import_id, $product_id, $amount, $price)
    {
        $sql = "
            INSERT INTO importdetail (import_id, product_id, amount, price, isDeleted)
            VALUES ($import_id, $product_id, $amount, $price, 0)
        ";
        return $this->conn->query($sql);
    }

    function softDelete($id)
    {
        $sql = "UPDATE import SET isDeleted = 1 WHERE id = $id";
        return $this->conn->query($sql);
    }
    function getDetails($importId)
    {
        $sql = "
        SELECT importdetail.*, product.title AS product_name
        FROM importdetail
        JOIN product ON product.id = importdetail.product_id
        WHERE importdetail.import_id = $importId
        AND importdetail.isDeleted = 0
    ";

        return $this->conn->query($sql);
    }
}
