<?php
require_once ("./data/Conexion.php");
require ("./data/CategoriaDAO.php");

class Categoria{
    private $idCategoria;
    private $nombre;

    public function getIdCategoria(){
        return $this->idCategoria;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function __construct($idCategoria=0, $nombre=""){
        $this -> idCategoria = $idCategoria;
        $this -> nombre = $nombre;
    }

    public function consultarTodasCategorias(){
        $listaCategorias = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        $conexion -> ejecutarConsulta($categoriaDAO -> consultarTodas());
        while($registro = $conexion -> siguienteRegistro()){
            $categoria = new Categoria($registro[0], $registro[1]);
            array_push($listaCategorias, $categoria);
        }
        $conexion -> cerrarConexion();
        return $listaCategorias;        
    }
    
}

?>