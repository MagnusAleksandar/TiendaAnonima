<?php
require_once ("./data/Conexion.php");
require ("./data/ProductoDAO.php");

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $marca;
    private $categoria;
    private $admin;

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getPrecioCompra () {
        return $this->precioCompra;
    }

    public function getPrecioVenta () {
        return $this->precioVenta;
    }

    public function getMarca(){
        return $this->marca;
    }
    
    public function getCategoria() {
        return $this->categoria;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function setIdProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setPrecioCompra($precioCompra){
        $this->precioCompra = $precioCompra;
    }

    public function setPrecioVenta($precioVenta){
        $this->precioVenta = $precioVenta;
    }

    public function setMarca($marca){
        $this->marca = $marca;
    }
    
    public function setCategoria($categoria): void {
        $this->categoria = $categoria;
    }

    public function setAdmin($admin): void {
        $this->admin = $admin;
    }

    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $marca=null, $categoria=null, $admin=null){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this -> marca = $marca;
        $this -> categoria = $categoria;
        $this -> admin = $admin;
    }
    
    public function consultarTodos(){
        $listaMarcas = array();
        $listaCategorias = array();
        $productos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO();
        $conexion -> ejecutarConsulta($productoDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){
            $marca = null;
            $categoria = null;
            if(array_key_exists($registro[5], $listaMarcas)){
                $marca = $listaMarcas[$registro[5]];
            }else{
                $marca = new Marca($registro[5]);
                $marca -> consultar();
                $listaMarcas[$registro[5]] = $marca;
            }
            if(array_key_exists($registro[6], $listaCategorias)){
                $categoria = $listaCategorias[$registro[6]];
            }else{
                $categoria = new Categoria($registro[6]);
                $categoria -> consultar();
                $listaCategorias[$registro[6]] = $categoria;
            }
            $producto = new Producto($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $marca, $categoria);
            array_push($productos, $producto);
        }
        $conexion -> cerrarConexion();
        return $productos;        
    }

    public function agregarProducto($idProducto, $nombre, $cantidad, $precioCompra, $precioVenta, $marca, $categoria, $admin){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO();
        $conexion -> ejecutarConsulta($productoDAO -> agregarProducto($idProducto, $nombre, $cantidad, $precioCompra, $precioVenta, $marca, $categoria, $admin));
        // $registro = $conexion -> siguienteRegistro();
        // $this -> $idProducto = $registro[0];
        // $this -> $nombre = $registro[1];
        // $this -> $cantidad = $registro[2];
        // $this -> $precioCompra = $registro[3];
        // $this -> $precioVenta = $registro[4];
        // $this -> $marca = $registro[5];
        // $this -> $categoria = $registro[6];
        // $this -> $admin = $registro[7];
        $conexion -> ejecutarConsulta($productoDAO -> consultar($idProducto));
        if($registro = $conexion -> siguienteRegistro()){
            $conexion -> cerrarConexion();
            return true;
        }else
            $conexion -> cerrarConexion();
            return false;
    }   

}

?>