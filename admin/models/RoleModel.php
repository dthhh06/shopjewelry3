<?php
class RoleModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllRoles() {
        $sql = "SELECT * FROM role WHERE isDeleted = 0 ORDER BY id";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRoleById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM role WHERE id = ? AND isDeleted = 0");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createRole($name, $description) {
        $stmt = $this->conn->prepare("INSERT INTO role (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        return $stmt->execute();
    }

    public function updateRole($id, $name, $description) {
        $stmt = $this->conn->prepare("UPDATE role SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
        return $stmt->execute();
    }

    public function deleteRole($id) {
        $stmt = $this->conn->prepare("UPDATE role SET isDeleted = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getPermissionsByRole($role_id) {
        $sql = "
            SELECT p.*, rp.isAllowed 
            FROM permission p
            LEFT JOIN role_permission rp ON p.id = rp.permission_id AND rp.role_id = ?
            ORDER BY p.group_name, p.id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $role_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateRolePermissions($role_id, $permissions) {
        $delete = $this->conn->prepare("DELETE FROM role_permission WHERE role_id = ?");
        $delete->bind_param("i", $role_id);
        $delete->execute();

        $insert = $this->conn->prepare("INSERT INTO role_permission (role_id, permission_id, isAllowed) VALUES (?, ?, ?)");
        foreach ($permissions as $perm_id => $isAllowed) {
            $allowed = $isAllowed ? 1 : 0;
            $insert->bind_param("iii", $role_id, $perm_id, $allowed);
            $insert->execute();
        }
        return true;
    }
}
?>