<?php
 
include("Forum/includes/debut.php"); 


?>

<html lang="en">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="js\jquery-ui-1.10.0.custom\jquery-ui-1.10.0.custom\development-bundle/themes/base/jquery.ui.all.css"> 
<link href="style.css" rel="stylesheet" media="all" type="text/css">  
<style type="text/css">
	#hidden { display: none; };
</style>      
</head>

<body style="background-color:black;">
<div id="body_image" style="background-image: url(images/fonds/4.jpg);">

<center><h1 style="font-size:90px;color:white;text-shadow: 0px 0px 30px black;"> Administration </h1></center>

<?php
if (isset($_POST["news"]) == 'ok') {
	include_once('Forum/includes/functions.php');
	$date=date("Y-m-j H:i:s");
	$titre=$_POST['titre'];
	$news=$_POST['news'];
	$message=$_POST['editor1'];
	?>
	<div id="backup_valid">
		<a>La news &agrave; &eacute;t&eacute; post&eacute;e !</a> <?php
		if (!empty($_FILES['image']['size'])) { 
			$name_image = move_photo($_FILES['image']); 
			// echo '<a style="color:white;"> nom => '.$name_image.'</a>';
		} 
		else{
			$name_image="";
		}
		?>
		<p><a href="index.php" style="color:#bbf2fb"> Retour &agrave; l'accueil </a></p>
	</div>
	<?php
		publier_news($date,$titre,$message,$name_image);
}
?>

	<form action="" id="form" name="form" method="post" enctype="multipart/form-data">	
	
	<div id="content_backup">
		<div id="fond_backup">
			<h1> Ajouter une news </h1>
			<table id="tab_backup">
				<tr>
					<td>Date : </td>
					<td><?php  echo date("m/d/y"); ?></td>
				</tr>
				<tr>
					<td>Titre : </td>
					<td><input type="text" id="titre" name="titre" style="width:820px;height:40px;font-size:20px;"></td>
				</tr>
				
				<tr>
					<td>Texte : </td>
					<td>
					<textarea id="editor1" name="editor1">Saisissez votre message ici .. </textarea>
					</td>
				</tr>
			</table>
				
			<br />
			<a style="color:black;">Avez-vous une image &agrave; publier ?  <input type="radio" onClick="afficher();"/> </a>
			<br />	
			<div id="hidden"><input type="file" name="image" /> <a name="label_image" id="label_image">(Taille max : 10Ko)</div> <!-- class="btn" -->
			<br />
			<br />

			<input type='hidden' id='news' name='news' value=''> 
			<div class="bouton">
				 <p>
						<a href="#" onclick="afficher_apercu()">Apercu</a>
				 </p>
			</div>
		</div>
	</div>
	
	<div id="backup_apercu">
		<div class="news">
			<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a id="titre_apercu" style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;"></a>

				<p style="color:#4be0f5;font-size:12px;margin-left:55px;"><?php echo date("m/d/y"); ?>></p></div>
				<fieldset style="margin-top:7px;border:1px solid grey;"> <p id="message_apercu"> </p></fieldset>
		</div>
		<br />	
		<div class="bouton">
			<a href="#" onclick="envoyer_formulaire()">Publier la news !</a>
		</div>	
	</div>
	
</form>
</div>
</body>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function afficher()
{
    document.getElementById("hidden").style.display = "block";
}

function envoyer_formulaire() {
	document.getElementById("news").value = "ok";
	document.getElementById('form').submit(); 
	return false;
}

function afficher_apercu() {
	
	document.getElementById('titre_apercu').innerHTML = document.getElementById("titre").value;
	
	// var text = document.getElementById("editor1").value;
	var  text = CKEDITOR.instances.editor1.getData();
	document.getElementById("message_apercu").innerHTML = text.replace(/\r\n|\n|\r/g, '<br />');

	document.getElementById("backup_apercu").style.display = "block";
	document.getElementById("backup_apercu").style.visibility='visible';
	return false;
}
</script>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
	
	window.onload = function()
	{
		CKEDITOR.replace( 'editor1' );
	};
</script>
</html>

