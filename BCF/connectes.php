<?php
  mysql_connect("localhost","loic56","yfv306");
  mysql_select_db("loic56_bcf");
  $timenow=time();
  $verif=mysql_query("SELECT COUNT(*) AS nbre_entrees FROM bcf_connectes WHERE ip='".$_SERVER['REMOTE_ADDR']."'");
  $retour=mysql_fetch_array($verif);
  if ($retour['nbre_entrees']==0)
  {
  mysql_query("INSERT INTO bcf_connectes VALUES('".$_SERVER['REMOTE_ADDR']."','".$timenow."')");
  }
  else
  {
  mysql_query("UPDATE bcf_connectes SET timestamp='$timenow' WHERE ip='".$_SERVER['REMOTE_ADDR']."'");
  }
  $time2=time() - (60*5);
  mysql_query("DELETE FROM bcf_connectes WHERE timestamp < '$time2'");
  
  $actu= mysql_query("SELECT COUNT(*) AS nbre_entrees FROM bcf_connectes");
  $donnees=mysql_fetch_array($actu);
  echo '<p style="text-align:center;">Il y a actuellement ' . $donnees['nbre_entrees'] . ' visiteurs connect&eacute;(s) </p>';
 ?>
