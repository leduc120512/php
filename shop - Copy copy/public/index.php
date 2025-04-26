<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../controllers/ProductController.php';
require_once '../controllers/OrderController.php';

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
        elseif ($action === 'register') $ctrl->register();
        elseif ($action === 'forgotPassword') $ctrl->forgotPassword();
        elseif ($action === 'updateUser') $ctrl->updateUser();
        else $ctrl->logout();
        break;
    case 'product':
        $ctrl = new ProductController();
        $ctrl2 = new OrderController();
        if ($action === 'index') $ctrl->index();
        elseif ($action === 'add') $ctrl->add();
        elseif ($action === 'edit' && $id) $ctrl->edit($id);
        elseif ($action === 'delete' && $id) $ctrl->delete($id);
        elseif ($action === 'detail' && $id) $ctrl->detail($id);
        elseif ($action === 'manage') $ctrl->manage();
        elseif ($action === 'searchAjax') $ctrl->searchAjax();
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
        
        // Xóa confirmPurchase nếu không dùng
        // elseif ($action === 'confirmPurchase') $ctrl->confirmPurchase();
        break;
    // case 'order':
    //     $ctrl = new OrderController();
    //     if ($action === 'buy') $ctrl->buy();
    //     elseif ($action === 'admin') $ctrl->admin();
    //     elseif ($action === 'updateStatus' && $order_id) $ctrl->updateStatus($order_id);
    //     elseif ($action === 'myOrders') $ctrl->myOrders();
    //     elseif ($action === 'exportExcel') $ctrl->exportExcel();
    //     elseif ($action === 'viewCart') $ctrl->viewCart();
    //     elseif ($action === 'removeFromCart' && $id) $ctrl->removeFromCart();
    //     elseif ($action === 'checkout') $ctrl->checkout();
    //     break; // Add this line
    case 'order':
        $ctrl = new OrderController();
        if ($action === 'buy') {
            $ctrl->buy();
        } elseif ($action === 'admin') {
            $ctrl->admin();
        } elseif ($action === 'updateStatus') {
            // Lấy order_id và status từ POST
            $order_id = isset($_POST['order_id']) ? filter_var($_POST['order_id'], FILTER_VALIDATE_INT) : null;
            $status = isset($_POST['status']) ? filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING) : null;

            if ($order_id && $status) {
                $ctrl->updateStatus($order_id, $status);
            } else {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid order_id or status']);
                exit;
            }
        } elseif ($action === 'myOrders') {
            $ctrl->myOrders();
        } elseif ($action === 'exportExcel') {
            $ctrl->exportExcel();
        } elseif ($action === 'viewCart') {
            $ctrl->viewCart();
        } elseif ($action === 'removeFromCart' && isset($id)) {
            $ctrl->removeFromCart($id);
        } elseif ($action === 'checkout') {
            $ctrl->checkout();
        }
        break;
    default:
        header("Location: ?controller=product&action=index");
        exit;
}