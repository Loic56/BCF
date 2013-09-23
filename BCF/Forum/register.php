<?php
session_start();
?>
<!doctype html>
 
<html lang="en">
<head>
<meta charset="utf-8" />
<link href="../style.css" rel="stylesheet" media="all" type="text/css">  
</head>
<body style="background-color:black;">
<div id="body_image" style="background-image: url(../images/fonds/4.jpg);">

<h1 style="font-size:90px;color:white;text-shadow: 0px 0px 30px black;margin-left:500px;"> Inscription </h1>
<div id="content_register">
<div id="fond_register" style="background-image: url(../images/fonds/7.jpg)">

<?php

$titre="Enregistrement";
include("includes/identifiants.php");
include("includes/debut.php");
 
if ($id!=0) erreur(ERR_IS_CO); 

if (empty($_POST['pseudo'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
    echo '<form method="post" action="register.php" enctype="multipart/form-data">
			<fieldset style="width:700px;background-color:grey;margin:auto;color:silver;font-size:15px;" >
			<legend style="font-size:20px;color:white;">Identifiants</legend>
				<table>
					<tr>
					<td>* Pseudo :</td>
					<td><input name="pseudo" type="text" id="pseudo" /> (le pseudo doit contenir entre 3 et 15 caract&egrave;res)</td>
					</tr>
					<tr>
					<td>*Votre adresse Mail :</td>
					<td><input type="text" name="email" id="email" /></td>
					</tr>
					<tr>
					<td>*Mot de Passe :</td>
					<td><input type="password" name="password" id="password" /></td>
					</tr>
					<tr>
					<td>*Confirmer le mot de passe :</td>
					<td><input type="password" name="confirm" id="confirm" /></td>
					</tr>
				</table>
			</fieldset>
	
			<fieldset style="width:700px;background-color:grey;color:silver;font-size:15px;margin:auto;margin-top:20px;">
			<legend style="font-size:20px;color:white;">Profil </legend>
				<table>
					<tr>
						<td>Choisissez votre avatar :</td>
						<td><input type="file" name="avatar" id="avatar" /> (Taille max : 10Ko)</td>
					</tr>
					<tr>
						<td>Signature :</td>
						<td><textarea cols="40" rows="4" name="signature" id="signature">La signature est limit&eacute;e &agrave; 200 caract&egrave;res</textarea></td>
					</tr>
				</table>
			</fieldset>
	
			<p class="rouge" style="margin-left:200px;">Les champs pr&eacute;c&eacute;d&eacute;s d\'un * sont obligatoires</p>
			<p style="margin-left:200px;"><input type="submit" value="Valider l\'inscription" /></p>
		</form>
    </div>
    </body>
    </html>';
    
} 
else {

    $pseudo_erreur1 = NULL;
    $pseudo_erreur2 = NULL;
    $mdp_erreur = NULL;
    $email_erreur1 = NULL;
    $email_erreur2 = NULL;
    $msn_erreur = NULL;
    $signature_erreur = NULL;
    $avatar_erreur = NULL;
    $avatar_erreur1 = NULL;
    $avatar_erreur2 = NULL;
    $avatar_erreur3 = NULL;

    //On récupère les variables
    $i = 0;
    $temps = time(); 
    $pseudo=$_POST['pseudo'];
    $signature = $_POST['signature'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $confirm = md5($_POST['confirm']);
     
    //Vérification du pseudo
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_pseudo =:pseudo');
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->execute();
    $pseudo_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$pseudo_free)
    {
        $pseudo_erreur1 = "Votre pseudo est d&eacute;j&agrave; utilis&eacute; par un membre";
        $i++;
    }
 
    if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
    {
        $pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
        $i++;
    }
 
    //Vérification du mdp
    if ($pass != $confirm || empty($confirm) || empty($pass))
    {
        $mdp_erreur = "Votre mot de passe et votre confirmation diff&egrave;rent, ou sont vides";
        $i++;
    }

	$query=$db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_pseudo =:pseudo');
	$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
	$query->execute();
	$pseudo_free=($query->fetchColumn()==0)?1:0;

    //Vérification de l'adresse email
 
    //Il faut que l'adresse email n'ait jamais été utilisée
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_email =:mail');
    $query->bindValue(':mail',$email, PDO::PARAM_STR);
    $query->execute();
    $mail_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
     
    if(!$mail_free)
    {
        $email_erreur1 = "Votre adresse email est d&eacute;j&agrave; utilis&eacute;e par un membre";
        $i++;
    }
    //On vérifie la forme maintenant
    if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
    {
        $email_erreur2 = "Votre adresse E-Mail n'a pas un format valide";
        $i++;
    }
    //Vérification de la signature
    if (strlen($signature) > 200)
    {
        $signature_erreur = "Votre signature est trop longue";
        $i++;
    }

    //Vérification de l'avatar :
    if (!empty($_FILES['avatar']['size']))
    {
		//echo '<a style="color:white"> taille : '.$_FILES['avatar']['size'].' </a>';
        //On définit les variables :
        $maxsize = 10024; //Poid de l'image
        $maxwidth = 100; //Largeur de l'image
        $maxheight = 100; //Longueur de l'image
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides
         
        if ($_FILES['avatar']['error'] > 0)
        {
                $avatar_erreur = "Erreur lors du transfert de l'avatar : ";
        }
        if ($_FILES['avatar']['size'] > $maxsize)
        {
                $i++;
                $avatar_erreur1 = "Le fichier est trop gros : (<strong>".$_FILES['avatar']['size']." Octets</strong>    contre <strong>".$maxsize." Octets</strong>)";
        }
 
        $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
        {
                $i++;
                $avatar_erreur2 = "Image trop large ou trop longue : 
                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
        }
         
        $extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
        if (!in_array($extension_upload,$extensions_valides) )
        {
                $i++;
                $avatar_erreur3 = "Extension de l'avatar incorrecte";
        }
    }

	
   if ($i==0)
   {
    echo'<h1 style="color:red;">Inscription termin&eacute;e ! </h1>';
    echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo'])).' vous &ecirc;tes maintenant inscrit sur le forum</p>
    <p>Cliquez <a style="color:#64dae2;" href="../index.php">ici</a> pour revenir &agrave; la page d\'accueil</p>';
    

        //La ligne suivante sera commentée plus bas
	$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):'';
	//$nomavatar='';
	
	$db->exec('INSERT INTO forum_membres (membre_pseudo, membre_mdp, membre_email, membre_avatar, membre_signature,  membre_inscrit,  membre_derniere_visite) 
		VALUES (\''.$pseudo.'\',\''.$pass.'\',\''.$email.'\',\''.$nomavatar.'\',\''.$signature.'\',\''.$temps.'\',\''.$temps.'\' ); ');

		
    //Et on définit les variables de sessions
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['id'] = $db->lastInsertId(); ;
        $_SESSION['level'] = 2;
        


    }
    else
    {
        echo'<h1 style="color:red;">Inscription interrompue</h1>';
        echo'<p>Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
        echo'<p>'.$i.' erreur(s)</p>';
        echo'<p>'.$pseudo_erreur1.'</p>';
        echo'<p>'.$pseudo_erreur2.'</p>';
        echo'<p>'.$mdp_erreur.'</p>';
        echo'<p>'.$email_erreur1.'</p>';
        echo'<p>'.$email_erreur2.'</p>';
        echo'<p>'.$msn_erreur.'</p>';
        echo'<p>'.$signature_erreur.'</p>';
        echo'<p>'.$avatar_erreur.'</p>';
        echo'<p>'.$avatar_erreur1.'</p>';
        echo'<p>'.$avatar_erreur2.'</p>';
        echo'<p>'.$avatar_erreur3.'</p>';
        
        echo'<p>Cliquez <a style="color:#64dae2;" href="./register.php">ici</a> pour recommencer</p>';
    }
}
?>
</div>
</div>
</div>
</body>
</html>
