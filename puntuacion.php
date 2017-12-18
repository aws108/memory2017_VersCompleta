<?php
  session_start();
  if(!isset($_SESSION["rlocal"]))
    $_SESSION["rlocal"]=array();
  $rlocal=$_SESSION["rlocal"];
  session_destroy();
  session_start();
  $_SESSION["rlocal"]=$rlocal;

  $name=$_POST["hnombre"];
  $score=$_POST["hscore"];
  $_SESSION["rlocal"][]=array($name,$score);
  $fichero = fopen("puntuaciones.txt", "a");
  fwrite($fichero,$name.",".$score."\n");
  fclose($fichero);
  header("Location: ranking.php");
?>
