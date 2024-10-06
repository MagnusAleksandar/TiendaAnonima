<?php
class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    
    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
    }
    
    public function consultarTodos(){
        return "SELECT idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca, Categoria_idCategoria FROM Producto";
    }

    public function consultarMarca($idMarca){
        return "SELECT nombre FROM Marca WHERE idMarca = $idMarca";
    }

    public function consultarCategoria($idCategoria){
        return "SELECT nombre FROM Categoria WHERE idCategoria = $idCategoria";
    }
}

?>