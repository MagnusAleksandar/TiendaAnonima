<?php
session_start();

require_once ("logic/Marca.php");
require_once ("logic/Categoria.php");
require_once ("logic/Producto.php");

$idMarca = filter_input(INPUT_POST, 'marca');
$idCategoria = filter_input(INPUT_POST, 'categoria');

if(isset($_POST["agregar"])){
    $producto = new Producto();
    // $_POST["idProd"], $_POST["nombreProd"], $_POST["cantProd"], null, $_POST["precVen"], $idMarca, $idCategoria, $_SESSION["id"]
    if(!empty($_POST["idProd"]) || empty($_POST["nombreProd"]) || empty($_POST["cantProd"]) || $idMarca = null || $idCategoria = null || empty($_POST["precVen"])){
        if($producto -> agregarProducto($_POST["idProd"], $_POST["nombreProd"], $_POST["cantProd"], null, $_POST["precVen"], $idMarca, $idCategoria, $_SESSION["id"]))
            echo "<div class='alert alert-success' role='alert'>Producto agregado correctamente.</div>";
        
    }else{
        echo "<div class='alert alert-danger' role='alert'>Debe completar el formulario</div>";
    }
}
?>

<html>
<head>
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
	rel="stylesheet">
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
        <div class="col-4"></div>
            <div class="col-4">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4>Añadir producto a inventorio</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="agregarProducto.php" >
                            <div class="form-group mb-3">
                                <input type="text" inputmode="numeric" name="idProd" class="form-control" placeholder="Código del producto">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="nombreProd" class="form-control" placeholder="Nombre del producto">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" inputmode="numeric" name="cantProd" class="form-control" placeholder="Cantidad" >
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" inputmode="numeric" name="precVen" class="form-control" placeholder="Precio del Producto" >
                            </div>
                            <div class="form-group mb-3">
                                <?php
                                    $marca = new Marca();
                                    $listaMarcas = $marca->consultarTodos();                    
                                ?>
                                <select class="form-control" name="marca">
                                    <option>Seleccione una marca</option>
                                    <?php
                                    foreach ($listaMarcas as $marcaActual) {
                                        echo "<option value='" . $marcaActual->getIdMarca() . "'>" . $marcaActual->getNombre() . "</option>";
                                    }                 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <?php
                                    $categoria = new Categoria();
                                    $listaCategoria = $categoria->consultarTodos();              
                                ?>
                                <select class="form-control" name="categoria">
                                <option>Seleccione una categoría</option>
                                    <?php
                                    foreach ($listaCategoria as $categoriaActual) {
                                        echo "<option value='" . $categoriaActual->getIdCategoria() . "'>" . $categoriaActual->getNombre() . "</option>";
                                    }                   
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" id="selectedBrand" name="selectedBrand">
                            <input type="hidden" id="selectedCategory" name="selectedCategory">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <button type="submit" name="agregar" class="btn btn-primary">Agregar</button>
                                </div>
                                <div class="col-7">
                                    <a href="sesionAdministrador.php" class="btn btn-primary" role="button">Volver a página principal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>