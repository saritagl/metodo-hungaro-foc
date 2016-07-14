<?php
    //  Arrancar la session para guardar los datos
    session_start();

	$tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6), array(9, 7, 10), array(4, 5, 11)));

    //  matriz para guardar los valores resultantes del pasoA
    $matrizPasoB = (isset($_SESSION['matrizPasoB']) ? $_SESSION['matrizPasoB'] : array());
    
    //  matriz para guardar los valores resultantes del pasoB
    $matrizPasoC = array();

    $soluciones = $otrasSoluciones = $filasSolucion = $otrasFilasSolucion = $columnasSolucion = $otrasColumnasSolucion = array();
    
    //  Calcular los ceros por cada valor de la columna
    for ($i = 0; $i < $tamanoMatriz; $i++) {
        $posiblesSoluciones = array();

        for ($j = 0; $j < $tamanoMatriz; $j++) {
            if ($matrizPasoB[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                $posiblesSoluciones[] = $i . '_' . $j;
            }
        }

        //  Si es la unica solucion de la fila 
        if (count($posiblesSoluciones) == 1) {
            $soluciones = reset($posiblesSoluciones);

            $posicion = explode('_', reset($posiblesSoluciones));

            $filasSolucion[] = $posicion[0];
            $columnasSolucion[] = $posicion[1];
        }
    }

    //  1
    if (count($soluciones) != $tamanoMatriz) {
        $otrasSoluciones = array();
        $otrasFilasSolucion = array();
        $otrasColumnasSolucion = array();
        
        for ($i = 0; $i < $tamanoMatriz; $i++) {
            for ($j = 0; $j < $tamanoMatriz; $j++) {
                if ($matrizPasoB[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                    $filasSolucion[] = $i;
                    $columnasSolucion[] = $j;
                    
                    $posiblesSoluciones[] = $i . '_' . $j;
                    
                    $otrasFilasSolucion[] = $i;
                    $otrasColumnasSolucion[] = $j;

                    $otrasSoluciones[] = $i . '_' . $j;
                }
            }
        }
    }

    //  2
    if (count($soluciones) != $tamanoMatriz) {
        $posiblesSoluciones = array_diff($posiblesSoluciones, $otrasSoluciones);
        $filasSolucion = array_diff($filasSolucion, $otrasFilasSolucion);
        $columnasSolucion = array_diff($columnasSolucion, $otrasColumnasSolucion);

        $otrasSoluciones = array();
        $otrasFilasSolucion = array();
        $otrasColumnasSolucion = array();
        
        for ($i = 0; $i < $tamanoMatriz; $i++) {
            for ($j = $tamanoMatriz - 1; $j > -1; $j--) {
                if ($matrizPasoB[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                    $filasSolucion[] = $i;
                    $columnasSolucion[] = $j;
                    
                    $posiblesSoluciones[] = $i . '_' . $j;
                    
                    $otrasFilasSolucion[] = $i;
                    $otrasColumnasSolucion[] = $j;

                    $otrasSoluciones[] = $i . '_' . $j;
                }
            }
        }
    }

    //  3
    if (count($soluciones) != $tamanoMatriz) {
        $posiblesSoluciones = array_diff($posiblesSoluciones, $otrasSoluciones);
        $filasSolucion = array_diff($filasSolucion, $otrasFilasSolucion);
        $columnasSolucion = array_diff($columnasSolucion, $otrasColumnasSolucion);

        $otrasSoluciones = array();
        $otrasFilasSolucion = array();
        $otrasColumnasSolucion = array();
        
        for ($i = $tamanoMatriz - 1; $i > -1; $i--) {
            for ($j = 0; $j < $tamanoMatriz; $j++) {
                if ($matrizPasoB[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                    $filasSolucion[] = $i;
                    $columnasSolucion[] = $j;
                    
                    $posiblesSoluciones[] = $i . '_' . $j;
                    
                    $otrasFilasSolucion[] = $i;
                    $otrasColumnasSolucion[] = $j;

                    $otrasSoluciones[] = $i . '_' . $j;
                }
            }
        }
    }

    //  4
    if (count($soluciones) != $tamanoMatriz) {
        $posiblesSoluciones = array_diff($posiblesSoluciones, $otrasSoluciones);
        $filasSolucion = array_diff($filasSolucion, $otrasFilasSolucion);
        $columnasSolucion = array_diff($columnasSolucion, $otrasColumnasSolucion);

        $otrasSoluciones = array();
        $otrasFilasSolucion = array();
        $otrasColumnasSolucion = array();
        
        for ($i = $tamanoMatriz - 1; $i > -1; $i--) {
            for ($j = $tamanoMatriz - 1; $j > -1; $j--) {
                if ($matrizPasoB[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                    $filasSolucion[] = $i;
                    $columnasSolucion[] = $j;
                    
                    $posiblesSoluciones[] = $i . '_' . $j;
                    
                    $otrasFilasSolucion[] = $i;
                    $otrasColumnasSolucion[] = $j;

                    $otrasSoluciones[] = $i . '_' . $j;
                }
            }
        }
    }
?>

<h4>Paso C)</h4>
<p>Identificar la solución óptima como la asignación factible asociada con las celdas cuyo valor quedo en cero después del paso (b). Si se encontró una solución factible, terminar el algoritmo. Si no se encontró una solución factible continuar con los pasos </p>

<div class="table-responsive">
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="50" class="text-center">-</th>
                <?php  for ($i = 0; $i < $tamanoMatriz; $i++) : ?>
                    <th class="text-center">x<?=$i?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < $tamanoMatriz; $i++) : ?>
            <tr>
                <th class="text-center">y<?=$i?></th>
                <?php
                    for ($j = 0; $j < $tamanoMatriz; $j++) :
                ?>
                    <td class="text-center" title=""><?=(int)$matrizPasoB[$i][$j]?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        <tbody>
    </table>
</div>

<?php
    //  Guardar la matrizPasoC para consultarla en el pasob
    $_SESSION['matrizPasoC'] = $matrizPasoC;
