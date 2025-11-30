<?php
class ContactModel {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả liên hệ chưa xóa
    function getAll() {
        $sql = "SELECT * FROM contact WHERE isDeleted = 0 ORDER BY id DESC";
        return $this->conn->query($sql);
    }

    // Lấy 1 liên hệ
    function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM contact WHERE id = $id LIMIT 1";
        return $this->conn->query($sql)->fetch_assoc();
    }

    // Xóa mềm
    function delete($id) {
        $id = (int)$id;
        $sql = "UPDATE contact SET isDeleted = 1 WHERE id = $id";
        return $this->conn->query($sql);
    }
}
