<?php
    
	$tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6, 3), array(9, 7, 10, 9), array(4, 5, 11, 7), array(8, 7, 8, 5)));
    
    //  matriz para guardar los valores resultantes del pasoA
    $matrizPasoA = array();
    
    $indicesMenoresPorFila = array();
    $valoresMenoresPorFila = array();
    
    //  Buscar el menor valor de cada fila y restarlo a cada uno de los elementos de esa fila.
    for ($i = 0; $i < $tamanoMatriz; $i++) {
        //  El menor se inicializa en un numero muy grande
        $menorDeLaFila = 1000000000000000000000;
        $indiceMenorDelaFila = 0;
        
        for ($j = 0; $j < $tamanoMatriz; $j++) {
            if ($matriz[$i][$j] < $menorDeLaFila) {
                $menorDeLaFila = $matriz[$i][$j];
                $indiceMenorDelaFila = $j;
            }
        }
        $indicesMenoresPorFila[$i] = $indiceMenorDelaFila;
        $valoresMenoresPorFila[$i] = $menorDeLaFila;
    }
    
  ?>
 
<h4>Paso A)</h4>
<p>Para cada fila de la tabla de costos, identificar el mínimo y restarlo a todos los valores de la fila.<br/></p>

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
                        $menor = ($indicesMenoresPorFila[$i] == $j);
                        
                        $matrizPasoA[$i][$j] = $matriz[$i][$j] - $valoresMenoresPorFila[$i];
                ?>
                    <td class="text-center <?=($menor ? 'success' : '')?>" title="<?=($menor ? 'La fila y' . ($i + 1) . ' tiene el menor valor que es : ' . $matriz[$i][$j] : '')?>"><?=(int)$matrizPasoA[$i][$j]?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        <tbody>
    </table>
</div>

<?php
    //  Guardar la matrizPasoA para consultarla en el pasob
    $_SESSION['matrizPasoA'] = $matrizPasoA;