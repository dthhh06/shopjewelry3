<?php
class RoleModel {

    public $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getAll() {
        return $this->conn->query("SELECT * FROM role WHERE isDeleted = 0");
    }

    function getById($id) {
        $id = (int)$id;
        return $this->conn->query("SELECT * FROM role WHERE id = $id")->fetch_assoc();
    }

    function insert($name) {
        $name = $this->conn->real_escape_string($name);
        return $this->conn->query("INSERT INTO role(name) VALUES('$name')");
    }

    function update($id, $name) {
        $id = (int)$id;
        $name = $this->conn->real_escape_string($name);
        return $this->conn->query("UPDATE role SET name='$name' WHERE id=$id");
    }

    function softDelete($id) {
        $id = (int)$id;
        return $this->conn->query("UPDATE role SET isDeleted = 1 WHERE id=$id");
    }

    /* ===================== PERMISSIONS ===================== */

    function getAllPermissions() {
        return $this->conn->query("SELECT * FROM permission");
    }

    function getRolePermissions($role_id) {
        $role_id = (int)$role_id;
        return $this->conn->query("SELECT * FROM role_permission WHERE role_id=$role_id");
    }

    function deleteRolePermissions($role_id) {
        $role_id = (int)$role_id;
        return $this->conn->query("DELETE FROM role_permission WHERE role_id=$role_id");
    }

    function addPermission($role_id, $permission_id, $isAllowed) {
        $role_id = (int)$role_id;
        $permission_id = (int)$permission_id;
        $isAllowed = (int)$isAllowed;

        $sql = "INSERT INTO role_permission(role_id, permission_id, isAllowed)
                VALUES($role_id, $permission_id, $isAllowed)";
        return $this->conn->query($sql);
    }
}
