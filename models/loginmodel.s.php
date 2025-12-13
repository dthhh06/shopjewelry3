<?php
class Login extends Database
{
    protected function getUser($useremail, $password)
    {
        $sql = "SELECT 
                    `id`, 
                    `email`, 
                    `password`, 
                    `fullname`, 
                    `phone_number`, 
                    `role_id`,
                    `avatar`
                FROM `user`
                WHERE `email` = ? AND `deleted` = 0;";

        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$useremail]);

            // Không tồn tại tài khoản
            if ($stmt->rowCount() == 0) {
                echo "usernotfound";
                exit();
            }

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Sai mật khẩu
            if (!password_verify($password, $user["password"])) {
                echo "wrongpassword";
                exit();
            }

            // ===== SET SESSION =====
            $_SESSION["id"] = $user["id"];
            $_SESSION["useremail"] = $user["email"];
            $_SESSION["fullname"] = $user["fullname"];
            $_SESSION["phone_number"] = $user["phone_number"];
            $_SESSION["role_id"] = $user["role_id"];
            $_SESSION["avatar"] = $user["avatar"]; 
            // ví dụ: ../assets/imgs/avatars/1765474371_1.jpg

        } catch (PDOException $e) {
            header("location: ../templates/login.php?error=stmtfailed");
            exit();
        }
    }
}
