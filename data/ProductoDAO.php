<?php
class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    
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
        return "SELECT idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca, Categoria_idCategoria, Administrador_idAdministrador FROM Producto";
    }
    
    public function agregarProducto($idProducto, $nombre, $cantidad, $precioCompra, $precioVenta, $marca, $categoria, $admin){
        return "INSERT INTO `producto`(`idProducto`, `nombre`, `cantidad`, `precioCompra`, `precioVenta`, `Marca_idMarca`, `Categoria_idCategoria`, `Administrador_idAdministrador`) 
                VALUES ('$idProducto', '$nombre', '$cantidad', '$precioCompra', '$precioVenta', '$marca', '$categoria', '$admin')";
    }

    public function consultar($idProducto){
        return "SELECT idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca, Categoria_idCategoria, Administrador_idAdministrador FROM Producto
        WHERE idProducto = $idProducto";
    }

}

?>