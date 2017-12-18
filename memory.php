<?php
SESSION_START(); //Iniciar sesión
//session_destroy();
//session_start();
?>

<html>
<head>
	<title>Formulario</title>
	<style>

		.green{background-color: green; width: 40%; }
		.yellow{background-color: yellow;width: 40%; }

	</style>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="main.css" />
	<script type="text/JavaScript" src="juego.js"></script>
</head>
<body background="background.jpg" onload="inicializar()">
	

	<?php
	//require('crea.php');
	//header("Refresh:0");
	//$segundos = 5;
	//header("Refresh:".$segundos);

		if(isset($_GET['restart']) && $_GET['restart'] == true){
			$nom = $_SESSION['nombre'];
			$filas = $_SESSION['filas'];
			$columnas = $_SESSION['columnas'];
			session_destroy();
			session_start();

			$_SESSION['nombre'] = $nom ;
			$_SESSION['filas'] = $filas;
			$_SESSION['columnas'] = $columnas;
			header("Location: memory.php");
			die();
		}

		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$_SESSION['nombre'] = $_POST['nombre'];
			$_SESSION['filas'] = $_POST['filas'];
			$_SESSION['columnas'] = $_POST['columnas'];
		}
		$nom = $_SESSION['nombre'];
		$filas = $_SESSION['filas'];
		$columnas = $_SESSION['columnas'];
		$fullCards = $filas*$columnas/2; //Declaramos el máximo de cartas /2 para evitar que salgan cartas sin pareja
		
		$x=0;
		$y=1;

		
		print "<img src=\"ok.png\">" ;

		echo "<br/>";

		echo "Logged! Your nick name is: $nom <br/> "; 

		echo "<br/>";
		//a r v 
		//5 6 7 
		$uno = array(0 => "51a.jpg", 1 => "51r.jpg",2 => "51v.jpg", 3 => "61a.jpg",
			4 => "61r.jpg",5 => "61v.jpg",6 => "71a.jpg", 
			7 => "71r.jpg",8 => "71v.jpg",9 => "trasera.jpg",10 => "mascuatro.jpg",11 => "11a.jpg",12 => "11r.jpg",13 => "11v.jpg",
			14 => "22v.jpg",15 => "22a.jpg",16 => "22r.jpg",17 => "33r.jpg",18 => "33a.jpg",19 => "33v.jpg",20 => "44r.jpg",
			21 => "44a.jpg",22 => "44v.jpg",23 => "88v.jpg",24 => "88a.jpg",25 => "88r.jpg");

		echo "<br/>";
		

		//$unoBaraja = array(); //baraja las cartas

		if(!isset($_SESSION["unoBaraja"])){ //isset — Determina si una variable está definida y no es NULL
			//unoBaraja son las cartas mezcladas
			$pairCards = array(); //Guarda las cartas pares. La necesitas para guardar cada grupo de pares
			$unoBaraja = array(); //Guardará un array de las cartas barajadas
				foreach($uno as $key => $value){ //Indice key value de todas las cartas
					$pairCards[] = array($key, $value); //Guardas en un array key value las que son las cartas pares
					$pairCards[] = array($key, $value);
					//$pairCards[] = array($key, $value);
						if ($y==$fullCards) { //if para salir del foreach a la que llegue al final de las fullCards. Empieza a partir de 1
							break;
        				} //if
        				$y++;
      			}//foreach

      	
			while(!empty($pairCards)){
        		$iCards = array_rand($pairCards); //iCards contendrá cada carta individual y estas son las que se barajan
        		$unoBaraja[] = array($pairCards[$iCards][0], $pairCards[$iCards][1]);
        		unset($pairCards[$iCards]);
      		}
      		$_SESSION["unoBaraja"]= $unoBaraja;
    	} //if isset

    	echo '<form id="hform" style="display:none;" method="post" action="puntuacion.php">
      			<input name="hnombre" id="hnombre" value="'.$nom.'"/>
      			<input name="hscore" id="hscore"/>
      			<input type="Submit" id="hsend"/>
    			</form>';
		
		//header("location:memory.php");

		echo "Memory: memorize the pairs cards. ";
		echo "<br/>";
		echo "<a href='crea.php'>Return to create page</a>";
		echo "<br/>";
		echo "<a href='memory.php?restart=true'>Restart game</a>";
		echo "<h3>Intentos: <span id='intentos'></span> </h3>";


		echo "<br/>";
		echo "<br/>";
		echo "<br/>";
		
		echo "<table>";

		for($i=0;$i<$filas;$i++){
			
			echo "<tr>";
			//echo "</td>"; 

			for($j=0;$j<$columnas;$j++){
				echo "<td>";
				
				echo '<div carta="'.$_SESSION["unoBaraja"][$x][0].'" class="card">';
         		echo "<div class='back'><img src='img/".$_SESSION["unoBaraja"][$x][1]."'></div>";
          		echo "<div class='front'><img src='img/trasera.jpg'></div>";

          		
          		echo "</div>";

				echo "</td>";
				$x++;

				}
				echo "</tr>";
		}
		echo "</table>";
	?>
	
</body>
</html>

