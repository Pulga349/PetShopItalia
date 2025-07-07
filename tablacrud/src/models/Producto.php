<?php
class Producto {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crear($nombre, $descripcion, $precio, $stock) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $stock);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function actualizar($id, $nombre, $descripcion, $precio, $stock) {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $stock, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function listarTodos($busqueda = "") {
        $sql = "SELECT id, nombre, descripcion, precio, stock, ultact FROM productos";
        if (!empty($busqueda)) {
            $sql .= " WHERE nombre LIKE ? OR descripcion LIKE ?";
            $busquedaParam = "%$busqueda%";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $busquedaParam, $busquedaParam);
        } else {
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        return $stmt->get_result();
    }
}