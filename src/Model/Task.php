<?php
class Task {
    private $pdo;

    public function __construct() {
        $dbFile = __DIR__ . '/../../tasks.sqlite';
        $this->pdo = new PDO('sqlite:' . $dbFile);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function save($title, $description, $dueDate, $assignedTo) {
    $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, due_date, assigned_to, done) VALUES (?, ?, ?, ?, 0)");
    $stmt->execute([$title, $description, $dueDate, $assignedTo]);
}

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM tasks ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $description, $dueDate, $assignedTo) {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, due_date, assigned_to) VALUES (:title, :description, :due_date, :assigned_to)");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':due_date', $dueDate);
        $stmt->bindValue(':assigned_to', $assignedTo);
        $stmt->execute();
    }

    public function markAsComplete($id) {
        $stmt = $this->pdo->prepare("UPDATE tasks SET done = 1 WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}