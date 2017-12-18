<?php
  session_start();
  if(!isset($_SESSION["rlocal"]))
    $_SESSION["rlocal"]=array();
  $rlocal=$_SESSION["rlocal"];
  session_destroy();
  session_start();
  $_SESSION["rlocal"]=$rlocal;
  function burbuja($array){
    for($i=1;$i<count($array);$i++){
      for($j=0;$j<count($array)-$i;$j++){
        if($array[$j]>$array[$j+1]){
          $k=$array[$j+1];
          $array[$j+1]=$array[$j];
          $array[$j]=$k;
        }
      }
    }
    return $array;
  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <title>Ranquing</title>
</head>
<body class="ranquing">
  <?php
    $fichero = fopen("puntuaciones.txt", "r");

    $contenido = array();
    while (!feof($fichero)){
      $linea = fgets($fichero);
      if(!empty($linea)){
        $pos = strpos($linea, ",");
        $jugador = substr($linea, 0, $pos);
        $score = substr($linea, $pos+1);
        $contenido[] = array($jugador, $score);
      }
    }
    fclose($fichero);
    $contenido=burbuja($contenido);
    echo "<div class='mundial'>";
    echo "<h2>Ranquing Mundial</h2>";
    echo "<table class='r'>";
    echo "<tr>";
    echo "<th class='cabecera'>Jugador</th>";
    echo "<th class='cabecera'>Intentos</th>";
    echo "</tr>";
    foreach ($contenido as $value) {
      echo "<tr>";
      echo "<td class='ra'>".$value[0]."</td><td class='ra'>  ".$value[1]."</td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    echo "<div class='local'>";
    echo "<h2>Ranquing Local</h2>";
    echo "<table class='r'>";
    echo "<tr>";
    echo "<th class='cabecera'>Jugador</th>";
    echo "<th class='cabecera'>Intentos</th>";
    echo "</tr>";
    $_SESSION["rlocal"]=burbuja($_SESSION["rlocal"]);
    foreach ($_SESSION["rlocal"] as $value) {
      echo "<tr>";
      echo "<td class='ra'>".$value[0]."</td><td class='ra'>  ".$value[1]."</td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
   ?>
  <div class="contenedor center">
    <h3>Quieres Jugar Otra Vez? </h3>
    <form action="memory.php" method="post">
      <input name="nombre" placeholder="Nombre: "></br></br>
      <input name="filas" placeholder="Numero de Filas: "/></br></br>
      <input name="columnas" placeholder="Numero de Columnas: "/></br></br>
      <input type="Submit" class="start" value="Start Game"/>
      <a href="crea.php" class="rank">Home</a>
    </form>
  </div>
</body>
</html>
