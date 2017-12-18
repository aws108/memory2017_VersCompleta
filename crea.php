<?php
session_start();
if(!isset($_SESSION["rlocal"]))
  $_SESSION["rlocal"]=array();
$rlocal=$_SESSION["rlocal"];
session_destroy();
session_start();
$_SESSION["rlocal"]=$rlocal;
?>

<html>
<head>
	<title>Crea una taula</title>
</head>
<body>

	<form action="memory.php" method="post">
		<p>Introduce your name: <input name="nombre" type="text"></p>
		<p>Filas: 
		<select name="filas"> 
			<option value="4" selected="selected">4</option>
			<option value="6" selected="selected">6</option>
			<option value="8" selected="selected">8</option>
		</select> </p>
		<p>Columnas: 
		<select name="columnas"> 
			<option value="4" selected="selected">4</option>
			<option value="6" selected="selected">6</option>
			<option value="8" selected="selected">8</option>
		</select> </p>
		<a href="ranking.php" class="rank">Ranquing</a>
		<!--<p>Filas: <input type="text" name="filas" /></p>
		<p>Columnas: <input type="text" name="columnas" /></p> -->
		<p><input type="submit" /></p>
	</form>

</body>
</html>




