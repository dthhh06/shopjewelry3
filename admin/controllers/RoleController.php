<?php
require_once "models/RoleModel.php";

class RoleController
{

    private $model;

    function __construct($db)
    {
        $this->model = new RoleModel($db);
    }

    function index()
    {
        $roles = $this->model->getAll();
        $view = "views/roles/list.php";
        include "layouts/main.php";
    }

    function create()
    {
        $view = "views/roles/create.php";
        include "layouts/main.php";
    }

    function store()
    {
        $this->model->insert($_POST['name']);
        header("Location: index.php?act=roles");
    }

    function edit()
    {
        $role = $this->model->getById($_GET['id']);
        $view = "views/roles/edit.php";
        include "layouts/main.php";
    }

    function update()
    {
        $this->model->update($_POST['id'], $_POST['name']);
        header("Location: index.php?act=roles");
    }

    function delete()
    {
        $this->model->softDelete($_GET['id']);
        header("Location: index.php?act=roles");
    }

    /* ===================== PERMISSIONS ===================== */

    function permissions()
    {
        $role_id = $_GET['id'];
        $role = $this->model->getById($role_id);
        $permissions = $this->model->getAllPermissions();

        $current = [];
        $rows = $this->model->getRolePermissions($role_id);
        while ($r = $rows->fetch_assoc()) {
            $current[$r['permission_id']] = $r['isAllowed'];
        }

        $view = "views/roles/permissions.php";
        include "layouts/main.php";
    }

    function savePermissions()
    {
        $role_id = $_POST['role_id'];

        $this->model->deleteRolePermissions($role_id);

        if (!empty($_POST['permissions'])) {
            foreach ($_POST['permissions'] as $pid => $on) {
                $this->model->addPermission($role_id, $pid, 1);
            }
        }

        header("Location: index.php?act=roles");
    }
}
