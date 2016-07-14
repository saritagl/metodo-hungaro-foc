<?php
    $tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6), array(9, 7, 10), array(4, 5, 11)));

    //  matriz para guardar los valores resultantes del pasoA
    $matrizPasoB = (isset($_SESSION['matrizPasoB']) ? $_SESSION['matrizPasoB'] : array());
    
    //  matriz para guardar los valores resultantes del pasoB
    $matrizPasoC = (isset($_SESSION['matrizPasoC']) ? $_SESSION['matrizPasoC'] : array());

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

    //  Calcular el menor valor de los valores que no estan tachados
    //  El menor se inicializa en un numero muy grande
    $menorDeLaMatriz = 1000000000000000000000;
    $indiceMenorDeLaMatriz = '';
    for ($i = 0; $i < $tamanoMatriz; $i++) {
        for ($j = 0; $j < $tamanoMatriz; $j++) {
            if ($matrizPasoB[$i][$j] < $menorDeLaMatriz && !in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                $menorDeLaMatriz = $matrizPasoB[$i][$j];
                $indiceMenorDeLaMatriz = $i . '-' . $j;
            }
        }
    }

    $matrizPasoC = $matrizPasoB;

    //  Se resta el menor valor a todas las celdas no tachadas
    for ($i = 0; $i < $tamanoMatriz; $i++) {
        for ($j = 0; $j < $tamanoMatriz; $j++) {
            if (!in_array($i, $filasSolucion) && !in_array($j, $columnasSolucion)) {
                //  Si no esta entre los valores que se van a tachar se le resta
                $matrizPasoC[$i][$j] = $matrizPasoB[$i][$j] - $menorDeLaMatriz;
            } else if (in_array($i, $filasSolucion) && in_array($j, $columnasSolucion)) {
                //  Si es la interseccion se le suma el $menorDeLaMatriz
                $matrizPasoC[$i][$j] = $matrizPasoB[$i][$j] + $menorDeLaMatriz;
            }
        }
    }

?>

<h4>Paso C.2)</h4>
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
                        $titulo = '';

                        if ($indiceMenorDeLaMatriz == $i . '-' . $j) {
                            $titulo = 'El valor ' . ((int)$menorDeLaMatriz) . ' es el menor valor de los elementos que no se va a tachar';
                        } else if (in_array($i, $filasSolucion) && in_array($j, $columnasSolucion)) {
                            $titulo = 'El valor ' . ((int)$matrizPasoB[$i][$j]) . ' es la interseccion';
                        }
                ?>
                    <td class="text-center <?=(in_array($i, $filasSolucion) || in_array($j, $columnasSolucion) ? 'danger' : ($indiceMenorDeLaMatriz == $i . '-' . $j ? 'success' : ''))?>" title="<?=$titulo?>"><?=(int)$matrizPasoC[$i][$j]?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        <tbody>
    </table>
</div>

<?php
    //  Guardar la matrizPasoC para consultarla en el pasob
    $_SESSION['matrizPasoC'] = $matrizPasoC;
