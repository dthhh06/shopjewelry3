<?php
class GalleryModel {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getAll() {
        $sql = "SELECT * FROM gallery";
        return $this->conn->query($sql);
    }

    function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM gallery WHERE id = $id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    function insert($title, $thumbnail) {
        $sql = "INSERT INTO gallery(title, thumbnail) VALUES ('$title', '$thumbnail')";
        return $this->conn->query($sql);
    }

    function update($id, $title, $thumbnail = null) {
        $id = (int)$id;

        if ($thumbnail) {
            $sql = "UPDATE gallery SET title='$title', thumbnail='$thumbnail' WHERE id=$id";
        } else {
            $sql = "UPDATE gallery SET title='$title' WHERE id=$id";
        }

        return $this->conn->query($sql);
    }

    function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM gallery WHERE id = $id";
        return $this->conn->query($sql);
    }
}
