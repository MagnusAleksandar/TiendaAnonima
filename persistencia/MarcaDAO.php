<?php
class MarcaDAO{
    private $idMarca;
    private $nombre;
    
    public function __construct($idMarca=0, $nombre=""){
        $this -> idMarca = $idMarca;
        $this -> nombre = $nombre;
    }
    
    public function consultarTodas(){
        return "select idMarca, nombre from Marca";
    }
    
}

?>