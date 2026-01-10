<?php
require_once __DIR__ . '/Database.php';

abstract class BaseDAO {
    protected $conn;
    protected $table;
    protected $modelClass = null;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function findAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();

        if ($this->modelClass) {
            return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
        }
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);

        if ($this->modelClass) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->modelClass);
            return $stmt->fetch();
        }
        return $stmt->fetch();
    }

    public function insert(array $data) {
        $fields = array_keys($data);
        $placeholders = array_fill(0, count($fields), '?');
        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ")
                VALUES (" . implode(',', $placeholders) . ")";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_values($data));
        return $this->conn->lastInsertId();
    }

    public function update($id, array $data) {
        $fields = array_keys($data);
        $set = implode(', ', array_map(fn($f) => "$f = ?", $fields));
        $sql = "UPDATE {$this->table} SET $set WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $values = array_values($data);
        $values[] = $id;
        return $stmt->execute($values);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}