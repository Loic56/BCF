
<link href="../js\jquery-ui-1.10.0.custom\jquery-ui-1.10.0.custom\development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" media="all" type="text/css">  

<?php

//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

/*
echo '<a style="color:white;"> id = '.$id.'</a>';
echo '<a style="color:white;"> lvl = '.$lvl.'</a>'; // */

$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
 
include_once("functions.php");
include_once("constants.php");


if (isset ($_COOKIE['pseudo']) && empty($id))
	{
	$_SESSION['pseudo'] = $_COOKIE['pseudo']; 
	// echo '<a style="color:white;">On créé la variable de session à partir du cookie pour ne pas avoir à vérifier 2 fois sur les pages qu\'un membre est connecté.</a>';
	/* On créé la variable de session à partir du cookie pour ne pas avoir à vérifier 2 fois sur les pages qu'un membre est connecté. */
	 
	}
	
if (isset ($_COOKIE['pseudo']) && !empty($id))
	{
	//echo '<a style="color:white;">On est connecté</a>';
	//On est connecté
	}
	
if (!isset ($_COOKIE['pseudo']) && empty($id))
	{
	//echo '<a style="color:white;">On n\'est pas connecté</a>';
	//On n'est pas connecté
	}
	
$balises=(isset($balises))?$balises:0;


if($balises)
{
?>
	<script>
	function bbcode(bbdebut, bbfin)
	{
	var input = window.document.formulaire.message;
	input.focus();
	if(typeof document.selection != 'undefined')
	{
	var range = document.selection.createRange();
	var insText = range.text;
	range.text = bbdebut + insText + bbfin;
	range = document.selection.createRange();
	if (insText.length == 0)
	{
	range.move('character', -bbfin.length);
	}
	else
	{
	range.moveStart('character', bbdebut.length + insText.length + bbfin.length);
	}
	range.select();
	}
	else if(typeof input.selectionStart != 'undefined')
	{
	var start = input.selectionStart;
	var end = input.selectionEnd;
	var insText = input.value.substring(start, end);
	input.value = input.value.substr(0, start) + bbdebut + insText + bbfin + input.value.substr(end);
	var pos;
	if (insText.length == 0)
	{
	pos = start + bbdebut.length;
	}
	else
	{
	pos = start + bbdebut.length + insText.length + bbfin.length;
	}
	input.selectionStart = pos;
	input.selectionEnd = pos;
	}
	  
	else
	{
	var pos;
	var re = new RegExp('^[0-9]{0,3}$');
	while(!re.test(pos))
	{
	pos = prompt("insertion (0.." + input.value.length + "):", "0");
	}
	if(pos > input.value.length)
	{
	pos = input.value.length;
	}
	var insText = prompt("Veuillez taper le texte");
	input.value = input.value.substr(0, pos) + bbdebut + insText + bbfin + input.value.substr(pos);
	}
	}
	function smilies(img)
	{
	window.document.formulaire.message.value += '' + img + '';
	}
	</script>
<?php
}
?>
