<?php
include_once("./layouts/auth.inc.php");

$conn = new mysqli("localhost:3307", "root", "", "web_trang_suc");
$act = $_GET['act'] ?? "dashboard";

switch ($act) {
    case "dashboard":
        require "controllers/DashboardController.php";
        $c = new DashboardController($conn);
        $c->index();
        break;
    case "products":
        require "controllers/ProductController.php";
        $c = new ProductController($conn);
        $c->index();
        break;
    case "product-create":
        require "controllers/ProductController.php";
        $c = new ProductController($conn);
        $c->create();
        break;

    case "product-store":
        require "controllers/ProductController.php";
        $c = new ProductController($conn);
        $c->store();
        break;

    case "product-edit":
        require "controllers/ProductController.php";
        $c = new ProductController($conn);
        $c->edit();
        break;

    case "product-update":
        require "controllers/ProductController.php";
        $c = new ProductController($conn);
        $c->update();
        break;

    case "product-delete":
        require "controllers/ProductController.php";
        $c = new ProductController($conn);
        $c->delete();
        break;
    case "category":
        require "controllers/CategoryController.php";
        $c = new CategoryController($conn);
        $c->index();
        break;

    case "category-create":
        require "controllers/CategoryController.php";
        $c = new CategoryController($conn);
        $c->create();
        break;

    case "category-store":
        require "controllers/CategoryController.php";
        $c = new CategoryController($conn);
        $c->store();
        break;

    case "category-edit":
        require "controllers/CategoryController.php";
        $c = new CategoryController($conn);
        $c->edit();
        break;

    case "category-update":
        require "controllers/CategoryController.php";
        $c = new CategoryController($conn);
        $c->update();
        break;

    case "category-delete":
        require "controllers/CategoryController.php";
        $c = new CategoryController($conn);
        $c->delete();
        break;
    case "users":
        require "controllers/UserController.php";
        $c = new UserController($conn);
        $c->index();
        break;

    case "user-create":
        require "controllers/UserController.php";
        $c = new UserController($conn);
        $c->create();
        break;

    case "user-store":
        require "controllers/UserController.php";
        $c = new UserController($conn);
        $c->store();
        break;

    case "user-edit":
        require "controllers/UserController.php";
        $c = new UserController($conn);
        $c->edit();
        break;

    case "user-update":
        require "controllers/UserController.php";
        $c = new UserController($conn);
        $c->update();
        break;

    case "user-delete":
        require "controllers/UserController.php";
        $c = new UserController($conn);
        $c->delete();
        break;
    case "order":
        require "controllers/OrderController.php";
        $c = new OrderController($conn);
        $c->index();
        break;

    case "order":
        require "controllers/OrderController.php";
        $c = new OrderController($conn);
        $c->index();
        break;

    case "order-detail":
        require "controllers/OrderController.php";
        $c = new OrderController($conn);
        $c->detail();
        break;

    case "order-update-status":
        require "controllers/OrderController.php";
        $c = new OrderController($conn);
        $c->updateStatus();
        break;

    case "order-delete":
        require "controllers/OrderController.php";
        $c = new OrderController($conn);
        $c->delete();
        break;


    case "supplier":
        require "controllers/SupplierController.php";
        $c = new SupplierController($conn);
        $c->index();
        break;

    case "supplier-create":
        require "controllers/SupplierController.php";
        $c = new SupplierController($conn);
        $c->create();
        break;

    case "supplier-store":
        require "controllers/SupplierController.php";
        $c = new SupplierController($conn);
        $c->store();
        break;

    case "supplier-edit":
        require "controllers/SupplierController.php";
        $c = new SupplierController($conn);
        $c->edit();
        break;

    case "supplier-update":
        require "controllers/SupplierController.php";
        $c = new SupplierController($conn);
        $c->update();
        break;

    case "supplier-delete":
        require "controllers/SupplierController.php";
        $c = new SupplierController($conn);
        $c->delete();
        break;
    case "import":
        require "controllers/ImportController.php";
        $c = new ImportController($conn);
        $c->index();
        break;

    case "import-create":
        require "controllers/ImportController.php";
        $c = new ImportController($conn);
        $c->create();
        break;

    case "import-store":
        require "controllers/ImportController.php";
        $c = new ImportController($conn);
        $c->store();
        break;

    case "import-show":
        require "controllers/ImportController.php";
        $c = new ImportController($conn);
        $c->show();
        break;

    case "import-delete":
        require "controllers/ImportController.php";
        $c = new ImportController($conn);
        $c->delete();
        break;

    case "roles":
        require "controllers/RoleController.php";
        (new RoleController($conn))->index();
        break;

    case "role-create":
        require "controllers/RoleController.php";
        (new RoleController($conn))->create();
        break;

    case "role-store":
        require "controllers/RoleController.php";
        (new RoleController($conn))->store();
        break;

    case "role-edit":
        require "controllers/RoleController.php";
        (new RoleController($conn))->edit();
        break;

    case "role-update":
        require "controllers/RoleController.php";
        (new RoleController($conn))->update();
        break;

    case "role-delete":
        require "controllers/RoleController.php";
        (new RoleController($conn))->delete();
        break;

    case "role-permissions":
        require "controllers/RoleController.php";
        (new RoleController($conn))->permissions();
        break;

    case "role-save-permissions":
        require "controllers/RoleController.php";
        (new RoleController($conn))->savePermissions();
        break;
    case "galleries":
        require "controllers/GalleryController.php";
        $c = new GalleryController($conn);
        $c->index();
        break;

    case "galleries-create":
        require "controllers/GalleryController.php";
        $c = new GalleryController($conn);
        $c->create();
        break;

    case "galleries-store":
        require "controllers/GalleryController.php";
        $c = new GalleryController($conn);
        $c->store();
        break;

    case "galleries-edit":
        require "controllers/GalleryController.php";
        $c = new GalleryController($conn);
        $c->edit();
        break;

    case "galleries-update":
        require "controllers/GalleryController.php";
        $c = new GalleryController($conn);
        $c->update();
        break;

    case "galleries-delete":
        require "controllers/GalleryController.php";
        $c = new GalleryController($conn);
        $c->delete();
        break;

    case "contact":
        require "controllers/ContactController.php";
        $c = new ContactController($conn);
        $c->index();
        break;

    case "contact-detail":
        require "controllers/ContactController.php";
        $c = new ContactController($conn);
        $c->detail();
        break;

    case "contact-delete":
        require "controllers/ContactController.php";
        $c = new ContactController($conn);
        $c->delete();
        break;
}
