<?php
require_once(__DIR__ . '/../config/conexiondb.php');
require_once(__DIR__ . '/../models/Producto.php');

class ProductoController {
    private $producto;
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->producto = new Producto($conn);
    }

    //Funcion que se utiliza tanto en editar como en crear para validaciones
    private function validarProducto($data) {
        $errores = [];
        $nombre = trim($data["nombre"] ?? "");
        $descripcion = trim($data["descripcion"] ?? "");
        $precio = trim($data["precio"] ?? "");
        $stock = trim($data["stock"] ?? "");

        if ($nombre === "") {
            $errores['nombre'] = "Por favor, ingrese un nombre.";
        }
        if ($descripcion === "") {
            $errores['descripcion'] = "Por favor, ingrese una descripción.";
        }
        if ($precio === "") {
            $errores['precio'] = "Por favor, ingrese un precio.";
        } elseif (!is_numeric($precio) || $precio < 0) {
            $errores['precio'] = "Por favor, ingrese un precio válido.";
        }
        if ($stock === "") {
            $errores['stock'] = "Por favor, ingrese la cantidad en stock.";
        } elseif (!filter_var($stock, FILTER_VALIDATE_INT) || $stock < 0) {
            $errores['stock'] = "Por favor, ingrese un número de stock válido.";
        }

        return [$errores, $nombre, $descripcion, $precio, $stock];
    }

    public function crear() {
        $nombre = $descripcion = $precio = $stock = "";
        $errores = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            list($errores, $nombre, $descripcion, $precio, $stock) = $this->validarProducto($_POST);
            if (empty($errores)) {
                if ($this->producto->crear($nombre, $descripcion, $precio, $stock)) {
                    header("location: ../index.php");
                    exit;
                } else {
                    $errores['general'] = "Error: No se pudo guardar el producto. Intenta de nuevo.";
                }
            }
        }
        require(__DIR__ . '/../views/productos/crear.php');
    }

    public function editar() {
        $id = "";
        $nombre = $descripcion = $precio = $stock = "";
        $errores = [];

        // Obtener ID del producto
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
            $id = $_POST["id"];
        } else if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            echo "Error: No se pudo obtener el id del producto. Intenta de nuevo.";
            return;
        }

        // Si es GET, cargar datos actuales del producto
        if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($id)) {
            $productoData = $this->producto->obtenerPorId($id);
            if ($productoData) {
                $nombre = $productoData["nombre"];
                $descripcion = $productoData["descripcion"];
                $precio = $productoData["precio"];
                $stock = $productoData["stock"];
            } else {
                echo "Error: Producto no encontrado.";
                exit;
            }
        }

        // Procesar formulario POST
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            list($errores, $nombre, $descripcion, $precio, $stock) = $this->validarProducto($_POST);
            // Si no hay errores, actualizar producto
            if (empty($errores)) {
                if ($this->producto->actualizar($id, $nombre, $descripcion, $precio, $stock)) {
                    header("location: ../index.php");
                    exit;
                } else {
                    $errores['general'] = "Error: No se pudo actualizar el producto. Intenta de nuevo.";
                }
            }
        }

        // Incluir la vista
        require(__DIR__ . '/../views/productos/editar.php');
    }

    public function eliminar() {
        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $id = $_GET["id"];
            if ($this->producto->eliminar($id)) {
                header("location: ../index.php");
                exit;
            } else {
                echo "Error: No se pudo eliminar el producto. Intenta de nuevo.";
            }
        } else {
            echo "Error: ID de producto no válido.";
        }
    }

    public function listar() {
        $busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";
        $result = $this->producto->listarTodos($busqueda);
        
        if ($result && $result->num_rows > 0) {
            require(__DIR__ . '/../views/productos/tabla.php');
        } else {
            echo "
            <div class='card'>
                <p>No se encontraron productos en el Stock. 
                <a href='productos/crear.php' class='btn btn-add' style='margin-left: 1em;'>Desea agregar un nuevo producto? ✔️</a>
                </p>
            </div>
            ";
        }
    }
}