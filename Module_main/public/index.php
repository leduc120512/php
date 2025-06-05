<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../controllers/ProductController.php';
require_once '../controllers/OrderController.php';
require_once '../controllers/FarmingProcessController.php';
require_once '../controllers/ArticleController.php';
require_once '../controllers/CategoryController.php';


// Bật error reporting để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;
$order_id = $_GET['order_id'] ?? null;

// Debug: In ra các tham số nhận được
// var_dump($_GET); // Xóa dòng này sau khi debug xong

switch ($controller) {
    case 'auth':
        $ctrl = new AuthController();
        if ($action === 'login') $ctrl->login();
        elseif ($action === 'list_accounts') $ctrl->list_accounts();
        elseif ($action === 'edit_account') $ctrl->edit_account();
        elseif ($action === 'delete_account') $ctrl->delete_account();
        elseif ($action === 'role_create_account') $ctrl->role_create_account();
        elseif ($action === 'register') $ctrl->register();
        elseif ($action === 'forgotPassword') $ctrl->forgotPassword();
        elseif ($action === 'updateUser') $ctrl->updateUser();
        else $ctrl->logout();
        break;
    case 'category':
        $ctrl = new CategoryController();
        if ($action === 'index') $ctrl->index();
        elseif ($action === 'create') $ctrl->create();
        elseif ($action === 'edit' && $id) $ctrl->edit($id);
        elseif ($action === 'delete' && $id) $ctrl->delete($id);
        else {
            header("Location: ?controller=category&action=index");
            exit;
        }
        break;
    case 'category_art':
        $ctrl = new ArticleController();
        if ($action === 'index') $ctrl->index_category();
        elseif ($action === 'create_category') $ctrl->create();
        elseif ($action === 'edit_category' && $id) $ctrl->edit_catergory($id);
        elseif ($action === 'delete_category' && $id) $ctrl->delete_category($id);
        elseif ($action === 'detail_Art' && $id) $ctrl3->detail2($id);
        else {
            header("Location: ?controller=category_art&action=index");
            exit;
        }
        break;
    case 'category_art':
        $ctrl = new ArticleController();
        if ($action === 'index') $ctrl->index_category();
        elseif ($action === 'create_category') $ctrl->create();
        elseif ($action === 'edit_category' && $id) $ctrl->edit_catergory($id);
        elseif ($action === 'detail_Art' && $id) $ctrl->detail2($id);
        elseif ($action === 'delete_category' && $id) $ctrl->delete_category($id);
        else {
            header("Location: ?controller=category_art&action=index");
            exit;
        }
        break;
    case 'product':
        $ctrl = new ProductController();
        $ctrl2 = new OrderController();

        if ($action === 'index') $ctrl->index();
        elseif ($action === 'add') $ctrl->add();
        elseif ($action === 'inventory') $ctrl->inventory();
        elseif ($action === 'edit' && $id) $ctrl->edit($id);
        elseif ($action === 'delete' && $id) $ctrl->delete($id);

        elseif ($action === 'remove_image') $ctrl->remove_image(); // Added support for remove_image action
        elseif ($action === 'detail' && $id) $ctrl->detail($id);
     
        elseif ($action === 'addComment') $ctrl->addComment(); // Thêm dòng này
        elseif ($action === 'addReply') $ctrl->addReply();
        elseif ($action === 'manage') $ctrl->manage();
        elseif ($action === 'addReview') $ctrl->addReview();
        elseif ($action === 'searchAjax') $ctrl->searchAjax();
        elseif ($action === 'searchAjax_2') $ctrl->searchAjax_2();
        elseif ($action === 'updateStatusUser') {
            // Lấy order_id và status từ POST
            $order_id = isset($_POST['order_id']) ? filter_var($_POST['order_id'], FILTER_VALIDATE_INT) : null;
            $status = isset($_POST['status']) ? filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING) : null;

            if ($order_id && $status) {
                $ctrl2->updateStatus($order_id, $status);
            } else {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid order_id or status']);
                exit;
            }
        };

        break;

    case 'order':
        $ctrl = new OrderController();
        if ($action === 'create') $ctrl->create();

        elseif ($action === 'admin') $ctrl->admin();
        elseif ($action === 'myOrders') $ctrl->myOrders();
        elseif ($action === 'exportExcel') $ctrl->exportExcel();
        elseif ($action === 'viewCart') $ctrl->viewCart();
       
        elseif ($action === 'removeFromCart' && $id) $ctrl->removeFromCart($id);

        break;
    case 'farming_process':
        $ctrl = new FarmingProcessController();
        if ($action === 'manage') $ctrl->manage();
        elseif ($action === 'add') $ctrl->add();
        elseif ($action === 'detail_fm' && $id) $ctrl->detail2($id);
        elseif ($action === 'edit' && $id) $ctrl->edit($id);
        elseif ($action === 'delete' && $id) $ctrl->delete($id);
        else {
            header("Location: ?controller=farming_process&action=manage");
            exit;
        }
        break;
    case 'article':
        $ctrl = new ArticleController(); // No need to pass $db since it's handled in the constructor
        if ($action === 'manage') $ctrl->manage();
        elseif ($action === 'add') $ctrl->add();
        elseif ($action === 'edit' && $id) $ctrl->edit($id);
        elseif ($action === 'delete' && $id) $ctrl->delete($id);
        elseif ($action === 'detail_Art' && $id) $ctrl->detail2($id);
        else {
            header("Location: ?controller=article&action=manage");
            exit;
        }
        break;
    default:
        header("Location: ?controller=product&action=index");
        exit;
}
