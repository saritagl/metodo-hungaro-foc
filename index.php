<?php
    //  Arrancar la session para guardar los datos
    session_start();

    //  Se comprueba si existe alguna error para mostrarlo en la vista
    $error = (isset($_GET['error']) ? $_GET['error'] : false);
    $nombreError = '';

    //  Se busca que error fue el que dio para mostrarlo en la vista
    switch ($error) {
        case 'archivoNoSeleccionado':
            $nombreError = 'No ha seleccionado un archivo para procesar';
            break;
        
        case 'archivoNoSoportado':
            $nombreError = 'Los archivos permitidos solo son *.txt, asegurese que el archivo tiene ese formato';
            break;

        case 'archivoNoEncontado':
            $nombreError = 'Ha ocurrido un error al copiar el archivo';
            break;

        case 'sinPermisosEnElArchivo':
            $nombreError = 'Ha ocurrido un error al leer el archivo';
            break;

        case 'primeraLinea':
            $nombreError = 'La primera linea del archivo debe ser un numero. El valor actual es ' . (isset($_GET['valor']) ? $_GET['valor'] : '');
            break;

        case 'lineaMatriz':
            $nombreError = 'La linea ' . (isset($_GET['linea']) ? $_GET['linea'] : '1') . ' del archivo tiene mas valores de los permitidos. Los permitidos son ' . (isset($_GET['valor']) ? $_GET['valor'] : '');
            break;

        default:
            $nombreError = 'Ha ocurrido un error procesando el archivo';
            break;
    }

    $tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6, 3), array(9, 7, 10, 9), array(4, 5, 11, 7), array(8, 7, 8, 5)));
    $tab = (isset($_SESSION['tab']) ? (int)$_SESSION['tab'] : 1);
    $resultadoProcesarMatriz = (isset($_GET['resultadoProcesarMatriz']) ? (int)$_GET['resultadoProcesarMatriz'] : 0);
?>

<!DOCTYPE html>
<html>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

  	<title>FOC</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">
	
    <body>
    	<!-- Nav bar -->
		<nav class="navbar navbar-default" id="header-navbar">
			<div class="container-fluid">
				<div class="navbar-header">
                    <a class="navbar-brand">
                        <i class="glyphicon glyphicon-th"></i>
                        El método húngaro</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
			</div>
		</nav>
    	<!-- /Nav bar -->

        <!-- Content -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Integrantes</div>
                        <div class="panel-body">
                            <ul>
                                <li>Olinda Lopez - V-21.217.126</li>
                                <li>Sara Garrido - V-21.017.654</li>
                                <li>Glery Cardoza - V-20.383.677</li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Cargar un archivo de texto</div>
                        <div class="panel-body">
                            <form action="subirArchivo.php" method="post" enctype="multipart/form-data" class="">
                                <div class="form-group <?= ($error ? 'has-error' : '') ?>">
                                    <label class="control-label">Seleccione el archivo a procesar</label>
                                    <input type="file" required name="archivo" accept=".txt" class="form-control" placeholder="Seleccione el archivo a procesar"/>
                                    <span class="help-block"><?=$nombreError?></span>
                                </div>
                                <button type="submit" clas="btn btn-default">Procesar archivo</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Tabla de costos</div>
                        <div class="panel-body">
                            <p>El tamaño de la matriz es de <b><?=$tamanoMatriz;?></b></p>

                            <!-- Mostrar matriz -->
                            <form action="actualizarMatriz.php">
                                <input type="hidden" name="tamanoMatriz" value="<?=$tamanoMatriz;?>"/>

                                <h4>Cargar la tabla de costos</h4>
                                <p>Actualizar la cantidad de variables de la tabla de costos<br/></p>
                                <div class="input-group input-group-sm col-xs-offset-4 col-xs-4">
                                    <input type="number" name="tamanoMatrizActualizado" value="<?=(int)$tamanoMatriz;?>" min="3" max="20" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i></button>
                                    </span>
                                </div>
                                <br/>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50" class="success text-center">-</th>
                                                <?php  for ($i = 1; $i <= $tamanoMatriz; $i++) : ?>
                                                    <th class="success text-center">x<?=$i?></th>
                                                <?php endfor; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 1; $i <= $tamanoMatriz; $i++) : ?>
                                            <tr>
                                                <th class="success text-center">y<?=$i?></th>
                                                <?php  for ($j = 1; $j <= $tamanoMatriz; $j++) : ?>
                                                    <td>
                                                        <input required name="matriz[<?=($i -1)?>][<?=($j - 1)?>]" class="form-control input-sm" type="number" value="<?=(int)$matriz[($i - 1)][($j - 1)]?>">
                                                    </td>
                                                <?php endfor; ?>
                                            </tr>
                                            <?php endfor; ?>
                                        <tbody>
                                    </table>
                                </div>

                                <div class="input-group input-group-sm col-xs-offset-4 col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block" name="botonProcesarMatriz">Procesar matriz</button>
                                </div>
                            </form>

                            <br/>

                            <div id="resultadoProcesarMatriz">
                                <?php
                                    if ($resultadoProcesarMatriz) {
                                        require('procesarMatriz.php');
                                    }
                                ?>
                            </div>
                            <!-- Mostrar matriz -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /Content -->

	<!-- jQuery 2.1.4 -->
	<script src="resources/js/jquery-2.1.4.min.js"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="resources/bootstrap/js/bootstrap.min.js"></script>
	
    <script type="text/javascript">
        $('#botonProcesarMatriz').click(function () {
            $('#resultadoProcesarMatriz').load('procesarMatriz.php');
        });
    </script>

	</body>
</html>