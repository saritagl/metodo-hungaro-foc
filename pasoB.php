<?php
    $tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6, 3), array(9, 7, 10, 9), array(4, 5, 11, 7), array(8, 7, 8, 5)));

    //  matriz para guardar los valores resultantes del pasoA
    $matrizPasoA = $matriz = (isset($_SESSION['matrizPasoA']) ? $_SESSION['matrizPasoA'] : array());
    
    //  matriz para guardar los valores resultantes del pasoB
    $matrizPasoB = array();
    
    $indicesMenoresPorColumna = array();
    $valoresMenoresPorColumna = array();
    $marcarMenoresPorColumna = array();
    
    //  Buscar el menor valor de cada columna y restarlo a cada uno de los elementos de esa fila.
    for ($j = 0; $j < $tamanoMatriz; $j++) {
        //  El menor se inicializa en un numero muy grande
        $menorDeLaColumna = 1000000000000000000000;
        $indiceMenorDelaColumna = 0;
        $indexMenorDelaColumna = '';
        
        for ($i = 0; $i < $tamanoMatriz; $i++) {
            if ($matriz[$i][$j] < $menorDeLaColumna) {
                $menorDeLaColumna = $matriz[$i][$j];
                $indiceMenorDelaColumna = $j;
                $indexMenorDelaColumna = $i . '_' . $j;
            }
        }

        $marcarMenoresPorColumna[$indexMenorDelaColumna] = $menorDeLaColumna;

        $indicesMenoresPorColumna[$j] = $indiceMenorDelaColumna;
        $valoresMenoresPorColumna[$j] = $menorDeLaColumna;
    }

    //  Transponer la matriz
    array_unshift($matrizPasoA, null);
    $matrizPasoA = call_user_func_array('array_map', $matrizPasoA);

    for ($j = 0; $j < $tamanoMatriz; $j++) {
        for ($i = 0; $i < $tamanoMatriz; $i++) {
            $menor = ($indicesMenoresPorColumna[$i] == $j);
                        
            $matrizPasoB[$i][$j] = $matrizPasoA[$i][$j] - $valoresMenoresPorColumna[$i];
        }
    }

    $matrizPasoBOriginal = $matrizPasoB;

    //  Acomodar la matriz que esta transpuesta
    for ($i = 0; $i < $tamanoMatriz; $i++) {
        for ($j = 0; $j < $tamanoMatriz; $j++) {
            $matrizPasoB[$i][$j] = $matrizPasoBOriginal[$j][$i];
        }
    }

?>

<h4>Paso B)</h4>
<p>Para cada columna de la tabla resultante, identificar el mínimo y restarlo a todos los elementos de la columna.<br/></p>

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
                        $menor = (isset($marcarMenoresPorColumna[$i . '_' . $j]));
                ?>
                    <td class="text-center <?=($menor ? 'success' : '')?>" title="<?=($menor ? 'La columna x' . ($i) . ' tiene el menor valor que es : ' . $valoresMenoresPorColumna[$j] : '')?>"><?=(int)$matrizPasoB[$i][$j]?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        <tbody>
    </table>
</div>

<?php
    //  Guardar la matrizPasoB para consultarla en el pasob
    $_SESSION['matrizPasoB'] = $matrizPasoB;
?>