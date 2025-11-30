<?php
class SupplierModel {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getAll() {
        $sql = "SELECT * FROM supplier WHERE isDeleted = 0 ORDER BY id DESC";
        return $this->conn->query($sql);
    }

    function getById($id) {
        $sql = "SELECT * FROM supplier WHERE id = $id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    function insert($name, $address, $contact) {
        $sql = "
            INSERT INTO supplier (name, address, contact) 
            VALUES ('$name', '$address', '$contact')
        ";
        return $this->conn->query($sql);
    }

    function update($id, $name, $address, $contact) {
        $sql = "
            UPDATE supplier 
            SET name='$name', address='$address', contact='$contact' 
            WHERE id = $id
        ";
        return $this->conn->query($sql);
    }

    function delete($id) {
        $sql = "UPDATE supplier SET isDeleted = 1 WHERE id = $id";
        return $this->conn->query($sql);
    }
}
