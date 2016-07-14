<?php
	$tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6, 3), array(9, 7, 10, 9), array(4, 5, 11, 7), array(8, 7, 8, 5)));

    //	Llamar al pasoA
	require('pasoA.php');
	
	//	Llamar al pasoB
	require('pasoB.php');
    
    do {
		//	Llamar al pasoC
		require('pasoC.php');

		//	Llamar al pasoC1
		require('pasoC1.php');

		//	Llamar al pasoC2
		require('pasoC2.php');

		//	Llamar al pasoC3
		require('pasoC3.php');
    } while (count($soluciones) != $tamanoMatriz);

?>

<h4>La matriz original</h4>

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
                    <td class="text-center <?=(in_array($i . '_' . $j, $soluciones) ? 'success' : '')?>" title=""><?=(int)$matriz[$i][$j]?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        <tbody>
    </table>
</div>