<?php
session_start();
?>

<body style="background-color:black;">
<div id="body_image" style="background-image: url(../images/fonds/4.jpg);">
<center><a style="color:white;font-size:120px;">Forum</a></center>
<div id="content_register">
	<div id="fond_register" style="background-image: url(../images/fonds/7.jpg);">
	<p>Vous êtes déconnecté !</p>
<?php
include("includes/debut.php");

	if (isset ($_COOKIE['pseudo']))
	{
	setcookie('pseudo', '', -1);
	}
	session_destroy();

?>
	<a style="color:#64dae2;" href="../index.php">Revenir à l'index</a>
	
</div>
</div>
</div>
</body>