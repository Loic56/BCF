<?php
session_start();
include("includes/debut.php");
include("includes/identifiants.php");
?>

<body>


<?php

if (isset($_POST['souvenir']))
{
	$_SESSION['pseudo']=$_POST['pseudo'];
	$expire = time() + 365*24*3600;
	setcookie('pseudo', $_SESSION['pseudo'], $expire); 
}

//echo '<a style="color:white;">id = '.$id.'</a>';

if ($id!=0) {
	erreur(ERR_IS_CO); 
}
	
else
{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<center><a style="color:white;font-size:120px;">Forum</a></center>
		<div id="content_register">
		<div id="fond_postok">
		<p>une erreur s\'est produite pendant votre identification.
		Vous devez remplir tous les champs</p>
		<p>Merci de resaisir vos identifiants</p>
		<form method="post" action="connexion.php">
		<fieldset>
		<legend>Connexion</legend>
		<p>
		<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
		<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
		</p>
		<label>Se souvenir de moi ?</label><input type="checkbox" name="souvenir" /><br />
		</fieldset>
		<p><input type="submit" value="Connexion" /></p></form>
		<a href="./register.php">Pas encore inscrit ?</a>
		<input type="hidden" name="page" value="<?php echo $_SERVER[\'HTTP_REFERER\']; ?>" />
		</form>';
    }
    else //On check le mot de passe
    {
        $query=$db->prepare('SELECT membre_mdp, membre_id, membre_rang, membre_pseudo
        FROM forum_membres WHERE membre_pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
    if ($data['membre_mdp'] == md5($_POST['password'])) // Acces OK !
    {
        $_SESSION['pseudo'] = $data['membre_pseudo'];
        $_SESSION['level'] = $data['membre_rang'];
        $_SESSION['id'] = $data['membre_id'];
        $message = '<center><a style="color:white;font-size:120px;">Forum</a></center>
			<div id="content_register">
			<div id="fond_postok">
			<p>Bienvenue '.$data['membre_pseudo'].', 
            vous êtes maintenant connecté!</p>
            <p>Cliquez <a href="../index.php">ici</a> 
            pour revenir à la page d accueil du forum</p>';  
    }
    else // Acces pas OK !
    {
        $message = '<center><a style="color:white;font-size:120px;">Forum</a></center>
		<div id="content_register">
		<div id="fond_postok">
		<p>Une erreur s\'est produite 
        pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correct.</p><p>Cliquez <a href="./connexion.php">ici</a> 
        pour revenir à la page précédente
        <br /><br />Cliquez <a href="./index.php">ici</a> 
        pour revenir à la page d accueil</p>';
    }
    $query->CloseCursor();
    }
    echo $message.'</div></div></body></html>';
 
 //$page = htmlspecialchars($_POST['page']);
 //echo 'Cliquez <a href="'.$page.'">ici</a> pour revenir à la page précédente';
}

?>
</div>
</body>