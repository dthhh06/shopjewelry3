<?php
class UserModel {

    public $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    function getAll() {
        $sql = "SELECT u.*, r.name AS role_name
                FROM user u
                LEFT JOIN role r ON u.role_id = r.id
                WHERE u.deleted = 0";
        return $this->conn->query($sql);
    }
    function getStaffs() {
    $sql = "
        SELECT * FROM user 
        WHERE role_id IN (1,2,4)   -- ADMIN & STAFF
    ";
    return $this->conn->query($sql);
}


    function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM user WHERE id = $id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    function insert($data) {
        $fullname = $this->conn->real_escape_string($data['fullname']);
        $email    = $this->conn->real_escape_string($data['email']);
        $phone    = $this->conn->real_escape_string($data['phone_number']);
        $role     = (int)$data['role_id'];
        
        // Hash password
        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (fullname, email, phone_number, password, role_id)
                VALUES ('$fullname', '$email', '$phone', '$password', $role)";
        return $this->conn->query($sql);
    }

    function update($id, $data) {
        $id = (int)$id;
        
        $fullname = $this->conn->real_escape_string($data['fullname']);
        $email    = $this->conn->real_escape_string($data['email']);
        $phone    = $this->conn->real_escape_string($data['phone_number']);
        $role     = (int)$data['role_id'];

        // Nếu có password mới thì cập nhật
        if (!empty($data['password'])) {
            $password = password_hash($data['password'], PASSWORD_BCRYPT);
            $sql = "UPDATE user SET 
                        fullname='$fullname', 
                        email='$email', 
                        phone_number='$phone',
                        role_id=$role,
                        password='$password'
                    WHERE id = $id";
        } else {
            $sql = "UPDATE user SET 
                        fullname='$fullname', 
                        email='$email', 
                        phone_number='$phone',
                        role_id=$role
                    WHERE id = $id";
        }

        return $this->conn->query($sql);
    }

    function softDelete($id) {
        $id = (int)$id;
        return $this->conn->query("UPDATE user SET deleted = 1 WHERE id = $id");
    }
}
