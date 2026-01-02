<?php
require_once __DIR__ . '/../models/RoleModel.php';

class RoleController {
    private $model;

    public function __construct($conn) {
        $this->model = new RoleModel($conn);
    }

    public function index() {
        $roles = $this->model->getAllRoles();
        $view = 'views/roles/list.php';
        include "layouts/main.php";
    }

    public function create() {
        $view = 'views/roles/create.php';
        include "layouts/main.php";
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = $_POST['description'] ?? '';

            if ($name === '') {
                $_SESSION['error'] = 'Tên role không được để trống!';
                header('Location: index.php?act=role-create');
                exit;
            }

            $this->model->createRole($name, $description);
            header('Location: index.php?act=role&success=created');
            exit;
        }
        header('Location: index.php?act=role');
        exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $role = $this->model->getRoleById($id);

        if (!$role) {
            $_SESSION['error'] = 'Role không tồn tại!';
            header('Location: index.php?act=role');
            exit;
        }

        $view = 'views/roles/edit.php';
        include "layouts/main.php";
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $name = trim($_POST['name'] ?? '');
            $description = $_POST['description'] ?? '';

            if ($id <= 0 || $name === '') {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ!';
                header('Location: index.php?act=role');
                exit;
            }

            $this->model->updateRole($id, $name, $description);
            header('Location: index.php?act=role&success=updated');
            exit;
        }
        header('Location: index.php?act=role');
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($id > 3) {
            $this->model->deleteRole($id);
            header('Location: index.php?act=role&success=deleted');
            exit;
        }
        header('Location: index.php?act=role&error=cannot_delete');
        exit;
    }

    public function permissions() {
        $id = $_GET['id'] ?? 0;
        $role = $this->model->getRoleById($id);

        if (!$role) {
            $_SESSION['error'] = 'Role không tồn tại!';
            header('Location: index.php?act=role');
            exit;
        }

        $permissions = $this->model->getPermissionsByRole($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $perms = $_POST['permission'] ?? [];
            $this->model->updateRolePermissions($id, $perms);
            header('Location: index.php?act=role-permissions&id=' . $id . '&success=updated');
            exit;
        }

        $view = 'views/roles/permissions.php';
        include "layouts/main.php";
    }
}
?>