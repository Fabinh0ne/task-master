<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Controller/TaskController.php';

$controller = new TaskController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'complete':
        $controller->complete();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}