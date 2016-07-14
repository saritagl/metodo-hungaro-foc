<?php
	//  Arrancar la session para guardar los datos
	session_start();
	
	//	Se captura lo que se mande en la variable archivo
	$archivo = (isset($_FILES['archivo']) ? $_FILES['archivo'] : null);

	//	Si se mando exitosamente el archivo se hacen otras comprobaciones
	if ($archivo) {
		if (isset($archivo['error']) && $archivo['error'] == UPLOAD_ERR_OK && isset($archivo['size']) && $archivo['size'] > 0) {
			//	Si el error del archivo es UPLOAD_ERR_OK y el tamaño del archivo es mayor a cero 
			//		quiere decir que es un archivo valido para procesar
		
			if ($archivo['type'] != 'text/plain') {
				//	Si el archivo que se suba tiene otro formato que no sea text/plain
				header('Location: index.php?error=archivoNoSoportado');	
				exit;
			}

			//	Si paso todas las validaciones se copia el archivo en la carpeta de uploads para procesarlo
			//	Comprobamos si el archivo fue subido
			if (isset($archivo['tmp_name']) && is_uploaded_file($archivo['tmp_name'])) {
				if (!move_uploaded_file($archivo['tmp_name'], 'uploads/' . $archivo['name'])) {
					header('Location: index.php?error=errorNoCategorizado');
				} else {
					//	Si el archivo se movio correctamente se procese a procesar el archivo
					if (file_exists('uploads/' . $archivo['name'])) {
						$punteroAlArchivo = @fopen('uploads/' . $archivo['name'], 'r');
						
						if ($punteroAlArchivo) {
							//	Si se abre correctamente el archivo se empieza a leer

							$tamanoMatriz = fgets($punteroAlArchivo);

							if ((int)$tamanoMatriz > 0) {
								$i = 0;
								$matriz = array();

								while (($lineaTexto = fgets($punteroAlArchivo))) {
									$matriz[$i] = explode(' ', $lineaTexto);

									if (count($matriz[$i]) > $tamanoMatriz) {
										//	Si la linea tiene mas valores de los permitidos entonces se indica el error
										header('Location: index.php?error=lineaMatriz&linea=' . ($i + 1) . '&valor=' . trim($tamanoMatriz));
									}
									$i++;
								}

								$_SESSION['tamanoMatriz'] = $tamanoMatriz;
								$_SESSION['matriz'] = $matriz;

								header('Location: index.php');
							} else {
								header('Location: index.php?error=primeraLinea&valor=' . $tamanoMatriz);
							}
						} else {
							header('Location: index.php?error=sinPermisosEnElArchivo');
						}
					} else {
						header('Location: index.php?error=archivoNoEncontado');
					}
				}
			} else {
				header('Location: index.php?error=errorNoCategorizado');
			}
		} else if(isset($archivo['error']) && $archivo['error'] == UPLOAD_ERR_NO_FILE) {
			//	Si el error del archivo es UPLOAD_ERR_NO_FILE quiere decir que no se subio ningun archivo
			//		se indica el erro para mostrarlo en la vista
			header('Location: index.php?error=archivoNoSeleccionado');	
		}
	} else {
		header('Location: index.php?error=archivoNoSeleccionado');
	}

	

