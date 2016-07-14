<?php
    //  Arrancar la session para guardar los datos
	session_start();

	$tamanoMatriz = (isset($_SESSION['tamanoMatriz']) ? (int)$_SESSION['tamanoMatriz'] : 3);
    $matriz = (isset($_SESSION['matriz']) ? $_SESSION['matriz'] : array(array(1, 4, 6, 3), array(9, 7, 10, 9), array(4, 5, 11, 7), array(8, 7, 8, 5)));

?>

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
</form>