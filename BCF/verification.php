<?php
include_once('Forum/includes/functions.php');

$login=$_POST['login'];
$pass=$_POST['pass'];



if(verification_log($login, $pass)=== 1){

echo '<script language="Javascript">
<!--
document.location.replace("backup.php");
// -->
</script>';

//header('Location: ');
} 
else {
	echo '<script language="Javascript">
	<!--
	document.location.replace("index.php");
	// -->
	</script>';
}
//header('Location: index.php');
?>