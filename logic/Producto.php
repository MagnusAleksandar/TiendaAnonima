<?php
require_once ("./data/Conexion.php");
require ("./data/ProductoDAO.php");

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $idMarca;
    private $idCategoria;

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

    public function getIdMarca(){
        return $this->idMarca;
    }

    public function getIdCategoria(){
        return $this->idCategoria;
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

    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    public function setIdMarca($idMarca){
        $this->idMarca = $idMarca;
    }

    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $idMarca=0, $idCategoria=0){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this -> idMarca = $idMarca;
    }
    
    public function consultarTodos(){
        $listaProductos = array();
        $listaIdMarcas = array();
        $listaIdCategorias = array();
        $listaMarcas = array();
        $listaCategorias = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO();
        $conexion -> ejecutarConsulta($productoDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){
            $id_marca = $registro[5];
            $id_categoria = $registro[6];
            $producto = new Producto($registro[0], $registro[1], $registro[2], $registro[3], $registro[4]);
            
            array_push($listaProductos, $producto);
            array_push($listaIdMarcas, $id_marca);
            array_push($listaIdCategorias, $id_categoria);
        }
        foreach($listaIdMarcas as $idMarcaActual){
            $conexion -> ejecutarConsulta($productoDAO -> consultarMarca($idMarcaActual));
            $marca = $conexion -> siguienteRegistro();
            array_push($listaMarcas, $marca[0]);
        }
        foreach($listaIdCategorias as $idMarcaActual){
            $conexion -> ejecutarConsulta($productoDAO -> consultarCategoria($idMarcaActual));
            $categoria = $conexion -> siguienteRegistro();
            array_push($listaCategorias, $categoria[0]);
        }
        
        for ($x = 0; $x < sizeof($listaProductos); $x++){
            $listaProductos[$x] -> setIdMarca($listaMarcas[$x]);
            $listaProductos[$x] -> setIdCategoria($listaCategorias[$x]);
        }
        return $listaProductos;
    }
    
}

?>