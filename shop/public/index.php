<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../controllers/ProductController.php';
require_once '../controllers/OrderController.php';

$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;
$order_id = $_GET['order_id'] ?? null;

switch ($controller) {
    case 'auth':
        $ctrl = new AuthController();
        if ($action === 'login') $ctrl->login();
        elseif ($action === 'register') $ctrl->register();
        elseif ($action === 'forgotPassword') $ctrl->forgotPassword();
        else $ctrl->logout();
        break;
    case 'product':
        $ctrl = new ProductController();
        if ($action === 'index') $ctrl->index();
        elseif ($action === 'add') $ctrl->add();
        elseif ($action === 'edit' && $id) $ctrl->edit($id);
        elseif ($action === 'delete' && $id) $ctrl->delete($id);
        elseif ($action === 'detail' && $id) $ctrl->detail($id);
        elseif ($action === 'manage') $ctrl->manage();
        elseif ($action === 'searchAjax') $ctrl->searchAjax();
        break;
    case 'order':
        $ctrl = new OrderController();
        if ($action === 'buy') $ctrl->buy();
        elseif ($action === 'admin') $ctrl->admin();
        elseif ($action === 'updateStatus' && $order_id) $ctrl->updateStatus($order_id);
        elseif ($action === 'myOrders') $ctrl->myOrders(); // Thêm dòng này
        break;
    default:
        header("Location: ?controller=product&action=index");
}