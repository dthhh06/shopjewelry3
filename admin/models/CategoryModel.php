<?php
class CategoryModel {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getAll() {
        $sql = "SELECT * FROM category WHERE isDeleted = 0";
        return $this->conn->query($sql);
    }

    function getById($id) {
        $sql = "SELECT * FROM category WHERE id = $id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    function insert($name) {
        $sql = "INSERT INTO category(name) VALUES ('$name')";
        return $this->conn->query($sql);
    }

    function update($id, $name) {
        $sql = "UPDATE category SET name = '$name' WHERE id = $id";
        return $this->conn->query($sql);
    }

    function delete($id) {
        $sql = "UPDATE category SET isDeleted = 1 WHERE id = $id";
        return $this->conn->query($sql);
    }
}
