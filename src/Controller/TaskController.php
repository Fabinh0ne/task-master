<?php
require_once __DIR__ . '/../Model/Task.php';

class TaskController {
    private $model;

    public function __construct() {
        $this->model = new Task();
    }

    public function index($error = null) {
        $tasks = $this->model->getAll();
        require __DIR__ . '/../View/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $dueDate = trim($_POST['due_date'] ?? '');
            $assignedTo = trim($_POST['assigned_to'] ?? '');

            if (empty($title) || empty($dueDate) || empty($assignedTo)) {
                $error = "O título, a data de vencimento e o responsável são obrigatórios!";
                $this->index($error);
                return;
            }

            $this->model->create($title, $description, $dueDate, $assignedTo);
            header("Location: index.php");
            exit;
        }
    }

    public function complete() {
        if (isset($_GET['id'])) {
            $this->model->markAsComplete((int)$_GET['id']);
        }
        header("Location: index.php");
        exit;
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->delete((int)$_GET['id']);
        }
        header("Location: index.php");
        exit;
    }
}