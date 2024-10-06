<?php
require_once ("./data/Conexion.php");
require ("./data/MarcaDAO.php");

class Marca{
    private $idMarca;
    private $nombre;

    public function getIdMarca(){
        return $this->idMarca;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setIdMarca($idMarca){
        $this->idMarca = $idMarca;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function __construct($idMarca=0, $nombre=""){
        $this -> idMarca = $idMarca;
        $this -> nombre = $nombre;
    }

    public function consultarTodasMarcas(){
        $listaMarcas = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $marcaDAO = new MarcaDAO();
        $conexion -> ejecutarConsulta($marcaDAO -> consultarTodas());
        while($registro = $conexion -> siguienteRegistro()){
            $marca = new Marca($registro[0], $registro[1]);
            array_push($listaMarcas, $marca);
        }
        $conexion -> cerrarConexion();
        return $listaMarcas;        
    }
    
}

?>