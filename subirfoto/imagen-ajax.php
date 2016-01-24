<?php
if(isset($_FILES["file"]))
		{
			$file=$_FILES["file"];
			$nombre=$file["name"];
			$tipo =$file["type"];
			$ruta_provisional=$file["tmp_name"];
			$size=$file["size"];
			$dimensiones=getimagesize($ruta_provisional);
			$width = $dimensiones[0];
			$height =$dimensiones[1];
			$carpeta="fusuarios/";
			$carpeta2="subirfoto/fusuarios/";
			if(file_exists($carpeta.$nombre))
			{
				$nombre="fotousuario".rand(1,10000).".jpg";
			if($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo !='image/gif')
		
			{    echo "Error el archivo no es una Imagen";	}

			else if($size > 1024*1024)
				{
					echo $nombre. " Error, el tamaño maximo permitido es 1 mb";
				}
			else if($width > 500 && $width<60 && $height>500 && $height<60 )
				{
					echo "Error en el anchura y altura de la imagen";
				}
			else 
			{
				$src = $carpeta.$nombre;
				$src2 = $carpeta2.$nombre;
				move_uploaded_file($ruta_provisional, $src);
				echo "<img src='$src2' class='img-thumbnail' alt='User Image'>";
				echo "<input type='text' id='archivo' value='$src' class='desvanecer'>";
			}				
			}else{

			if($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo !='image/gif')
		
			{    echo "Error el archivo no es una Imagen";	}

			else if($size > 1024*1024)
				{
					echo $nombre. " Error, el tamaño maximo permitido es 1 mb";
				}
			else if($width > 500 && $width<60 && $height>500 && $height<60 )
				{
					echo "Error en el anchura y altura de la imagen";
				}
			else 
			{
				$src = $carpeta.$nombre;
				$src2 = $carpeta2.$nombre;
				move_uploaded_file($ruta_provisional, $src);
				echo "<img src='$src2' class='img-thumbnail' alt='User Image'>";
				echo "<input type='text' id='archivo' value='$src' class='desvanecer'>";
			}
		}
	}

?>