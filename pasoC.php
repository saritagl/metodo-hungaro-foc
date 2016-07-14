<?php
    $tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6), array(9, 7, 10), array(4, 5, 11)));

    //  matriz para guardar los valores resultantes del pasoA
    $matrizPasoB = (isset($_SESSION['matrizPasoB']) ? $_SESSION['matrizPasoB'] : array());
    
    $soluciones = $filasSolucion = $columnasSolucion = array();
    
    //  Calcular las columns que se deben tachar
    for ($i = 0; $i < $tamanoMatriz; $i++) {
    	$cerosFilas = $cerosColumnas = 0;

		for ($j = 0; $j < $tamanoMatriz; $j++) {
			if ($matrizPasoB[$i][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
				$cerosFilas++;
				$cerosColumnas++;
				
				for ($k = $j; $k < $tamanoMatriz; $k++) {
					if ($matrizPasoB[$i][$k] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
						$cerosFilas++;
					}
				}
				
				for ($k = $i; $k < $tamanoMatriz; $k++) {
					if ($matrizPasoB[$k][$j] == 0 && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
						$cerosColumnas++;
					}
				}

				if ($cerosFilas > $cerosColumnas) {
					$filasSolucion[] = $i;
				} else {
					$columnasSolucion[] = $j;
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
                ?>
                    <td class="text-center <?=(in_array($i, $filasSolucion) || in_array($j, $columnasSolucion) ? 'danger' : '')?>" title=""><?=(int)$matrizPasoB[$i][$j]?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        <tbody>
    </table>
</div>
