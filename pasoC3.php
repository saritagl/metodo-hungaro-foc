<?php
    $tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6), array(9, 7, 10), array(4, 5, 11)));

    //  matriz para guardar los valores resultantes del pasoA
    $matrizPasoB = (isset($_SESSION['matrizPasoB']) ? $_SESSION['matrizPasoB'] : array());
    
    //  matriz para guardar los valores resultantes del pasoB
    $matrizPasoC = (isset($_SESSION['matrizPasoC']) ? $_SESSION['matrizPasoC'] : array());

    $soluciones = $otrasSoluciones = $posiblesSoluciones = $filasSolucion = $columnasSolucion = array();
   
    //  Calcular los ceros por cada valor de la columna
    for ($i = 0; $i < $tamanoMatriz; $i++) {
        $posiblesSoluciones = array();

        for ($j = 0; $j < $tamanoMatriz; $j++) {
            if ($matrizPasoC[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                $posiblesSoluciones[] = $i . '_' . $j;
            }
        }

        //  Si es la unica solucion de la fila 
        if (count($posiblesSoluciones) == 1) {
            $solucion = reset($posiblesSoluciones);
            
            $soluciones[] = $solucion;

            $posicion = explode('_', $solucion);

            $filasSolucion[] = $posicion[0];
            $columnasSolucion[] = $posicion[1];
            $i =-1;
        }
    }

    //  1
    if (count($soluciones) != $tamanoMatriz) {
        $otrasSoluciones = array();
        $otrasFilasSolucion = array();
        $otrasColumnasSolucion = array();
        
        for ($i = 0; $i < $tamanoMatriz; $i++) {
            for ($j = 0; $j < $tamanoMatriz; $j++) {
                if ($matrizPasoC[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
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
                if ($matrizPasoC[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
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
                if ($matrizPasoC[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
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
                if ($matrizPasoC[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
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

    $soluciones = array_merge($soluciones, $otrasSoluciones);
?>

<h4>Paso C.3)</h4>
<p>Encontrar el menor elemento no tachado. Este elemento le se debe restar a todos los elementos no tachados y sumar a las intersecciones de las líneas.</p>

<div class="table-responsive">
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="50" class="text-center">-</th>
                <?php  for ($i = 0; $i < $tamanoMatriz; $i++) : ?>
                    <th class="text-center <?=(in_array($i, $columnasSolucion) ? 'danger' : '')?>">x<?=$i?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < $tamanoMatriz; $i++) : ?>
            <tr>
                <th class="text-center <?=(in_array($i, $filasSolucion) ? 'danger' : '')?>">y<?=$i?></th>
                <?php
                    for ($j = 0; $j < $tamanoMatriz; $j++) :
                        $claseCSS = (in_array($i, $filasSolucion) || in_array($j, $columnasSolucion) ? 'danger' : '');
                        $titulo = '';

                        if (in_array($i . '_' . $j, $soluciones)) {
                            $claseCSS = 'success';
                            $titulo = 'El valor de esta celda es : ' . $matriz[$i][$j];
                        }
                ?>
                    <td class="text-center <?=$claseCSS?>" title="<?=$titulo?>"><?=(int)$matrizPasoC[$i][$j]?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        <tbody>
    </table>
</div>

<br/>

<?php
    $textoSolucion = '';
    $totalSolucion = 0;
    $i = 1;

    foreach ($soluciones as $solucion) {
        $posicion = explode('_', $solucion);

        $textoSolucion.= $matriz[$posicion[0]][$posicion[1]] . ((count($soluciones) != $i) ? ' + ' : '');
        $totalSolucion+= $matriz[$posicion[0]][$posicion[1]];
        $i++;
    }

    $textoSolucion.= ' = ' . $totalSolucion;
?>

<?php 
    if (count($soluciones) == $tamanoMatriz) :
?>
    <div class="panel-body">
        <div class="alert alert-info alert-dismissible">
            <h4>¡ Tiene solucion !</h4>
            La solucion es : <?=$textoSolucion?>
        </div>
    </div>
<?php 
    else:
?>
    <div class="panel-body">
        <div class="alert alert-danger  alert-dismissible">
            <h4>¡ NO Tiene solucion!, repetir el paso C</h4>
        </div>
    </div>

<?php 
    endif;
?>




