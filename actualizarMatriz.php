<?php
	//  Arrancar la session para guardar los datos
	session_start();

	$tamanoMatrizActualizado = (isset($_GET['tamanoMatrizActualizado']) ? (int)$_GET['tamanoMatrizActualizado'] : $_SESSION['tamanoMatriz']); 
	$tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3); 
    $matriz = (isset($_GET['matriz']) ? $_GET['matriz'] : (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array()));

    $resultadoProcesarMatriz = (isset($_GET['botonProcesarMatriz']) ? '?resultadoProcesarMatriz=1' : '');

    if ($tamanoMatrizActualizado > $tamanoMatriz) {
    	//	Si se cumple esta condicion quiere decir que se estan anexando nuevas filas a la matriz

    	$cantidadNuevos = $tamanoMatrizActualizado - $tamanoMatriz;

    	for ($i = 0; $i < $tamanoMatrizActualizado; $i++) {
    		for ($j = 0; $j < $tamanoMatrizActualizado; $j++) {
    			if (!isset($matriz[$i][$j])) {
    				$matriz[$i][$j] = rand(1, 20);
	    		}
    		}
    	}

		$_SESSION['tamanoMatriz'] = $tamanoMatrizActualizado;
		$_SESSION['matriz'] = $matriz;
    } else if ($tamanoMatriz > $tamanoMatrizActualizado) {
    	//	Si es cumple esta condicion quiere decir que se deben eliminar las columnas

    	$cantidadAEliminar = $tamanoMatriz - $tamanoMatrizActualizado;

    	for ($i = $tamanoMatriz; $i < ($tamanoMatriz + $cantidadAEliminar); $i++) {
    		for ($j = $tamanoMatriz; $j < ($tamanoMatriz + $cantidadAEliminar); $j++) {
    			if (isset($matriz[$i][$j])) {
    				unset($matriz[$i][$j]);
	    		}
    		}
    	}

    	$_SESSION['tamanoMatriz'] = ($tamanoMatriz - $cantidadAEliminar);
		$_SESSION['matriz'] = $matriz;
    } else if ($tamanoMatrizActualizado == $tamanoMatriz) {
    	//	Si los dos tamaños son iguales entonces no se hace nada y se retorna

    	$_SESSION['matriz'] = $matriz;
    }

    header('Location: index.php' . $resultadoProcesarMatriz);
    exit;