<?php
class CategoriaDAO{
    private $idCategoria;
    private $nombre;
    
    public function __construct($idCategoria=0, $nombre=""){
        $this -> idCategoria = $idCategoria;
        $this -> nombre = $nombre;
    }
    
    public function consultarTodos(){
        return "SELECT idCategoria, nombre FROM Categoria";
    }

    public function consultar(){
        return "SELECT nombre FROM categoria WHERE idCategoria = '" . $this -> idCategoria . "'";
    }
}

?>