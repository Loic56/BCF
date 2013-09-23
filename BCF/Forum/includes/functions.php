<?php
//session_start();

function erreur($err=''){
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<center><a style="color:white;font-size:60px;">Erreur !</a></center>
   <div id="content_erreur">
	<div id="fond_erreur"><div id="error"><p>'.$mess.'</p>
   <p>Cliquez <a href="../index.php">ici</a> pour revenir à la page d\'accueil</p></div></div></div></div></body></html>');
}


function move_avatar($avatar){
	$extension_upload = strtolower(substr(strrchr($avatar['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "images/avatars/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar; 
	
}

function move_photo($photo_news){
	$extension_upload = strtolower(substr(strrchr($photo_news['name'], '.')  ,1));
    $name = time();
    $name = "images/photos_news/".str_replace(' ','',$name).".".$extension_upload; 
    move_uploaded_file($photo_news['tmp_name'],$name);
	return $name;
}

function envoyer_mail($nom, $prenom, $mail, $tel, $message)
{
	$destinataire = 'loic.crusson@live.fr';
	// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
	$expediteur = $mail;
	$copie = 'loic.crusson@live.fr';
	$copie_cachee = 'loic.crusson@live.fr';
	$objet = 'BCF - Demande de renseignements - BCF '; // Objet du message
	$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
	$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n"; // l'en-tete Content-type pour le format HTML
	$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
	$headers .= 'From: "'.$nom.' '.$prenom.'"<'.$expediteur.'>'."\n"; // Expediteur
	$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
	$headers .= 'Cc: '.$copie."\n"; // Copie Cc
	$headers .= 'Bcc: '.$copie_cachee."\n\n"; // Copie cachée Bcc        
	$message = '<div style="width: 100%; text-align: center; font-weight: bold">'.$message.'</div>
	</br></br>
	<ul>
		<li>'.$nom.' '.$prenom.'</li>
		<li>'.$tel.'</li>
	</ul>';
	if (mail($destinataire, $objet, $message, $headers)) // Envoi du message
	{
		return 1;
	}
	else // Non envoyé
	{
		return 0;
	}
}

function connect(){
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=loic56_bcf', 'loic56', 'yfv306');
	}
	catch (Exception $e)
	{
	 die('Erreur : ' . $e->getMessage());
		$db="";
	}
	return $db;
}


function publier_news($date,$titre,$message,$image){
	$db=connect();
	/* echo '<a style="color:white;">date ='. $date.'</a>';
	echo '</br>';
	echo '<a style="color:white;">'. htmlspecialchars(addslashes($message)).'</a>';
	echo '</br>'; 
	echo '<a style="color:white;"> INSERT INTO bcf_news (titre, contenu, image, date_creation) VALUES (\''.$titre.'\',\''.addslashes($message).'\',\''.$image.'\',\''.$date.'\');  </a>'; // */
	$db->exec('INSERT INTO bcf_news (titre, contenu, image, date_creation) VALUES (\''.$titre.'\',\''.addslashes($message).'\',\''.$image.'\',\''.$date.'\'); ');
}


function verification_log($login, $pass){
	$bdd=connect();
	$tab_admin = array();
	$i=0;
	$retour="";
	$reponse = $bdd->query('SELECT * FROM bcf_admin');
	while ($donnees = $reponse->fetch())
	{
		$tab_admin[$i][0] = $donnees[0];
		$tab_admin[$i][1] = $donnees[1];
		$tab_admin[$i][2] = $donnees[2];
		$i++;
	}

	
foreach ($tab_admin as $value) {
	echo $login .'</br>'.$pass; 
	echo '</br>';
	print_r($value);

	if( $value[1] == $login && $value[2]==$pass){
			$retour=1;
		}
	}
	return $retour;
}


function recuperer_news(){
	$bdd=connect();
	$tab_news = array();
	$i=0;
	$reponse = $bdd->query('SELECT * FROM bcf_news ORDER BY id DESC ');
	while ($donnees = $reponse->fetch())
	{
		$tab_news[$i][0] = $donnees[0];
		$tab_news[$i][1] = $donnees[1];
		$tab_news[$i][2] = $donnees[2];
		$tab_news[$i][3] = $donnees[3];
		$tab_news[$i][4] = $donnees[4];
		$i++;
	}
	return $tab_news;
}

function code($texte)
{
	//Smileys
	$texte = str_replace(':D ', '<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" />', $texte);
	$texte = str_replace(':lol: ', '<img src="./images/smileys/lol.gif" title="lol" alt="lol" />', $texte);
	$texte = str_replace(':triste:', '<img src="./images/smileys/triste.gif" title="triste" alt="triste" />', $texte);
	$texte = str_replace(':frime:', '<img src="./images/smileys/cool.gif" title="cool" alt="cool" />', $texte);
	$texte = str_replace('XD', '<img src="./images/smileys/rire.gif" title="rire" alt="rire" />', $texte);
	$texte = str_replace(':siffle', '<img src="./images/smileys/siffle.gif" title="siffle" alt="siffle" />', $texte);
	$texte = str_replace(':O', '<img src="./images/smileys/waw.gif" title="choc" alt="choc" />', $texte);
	$texte = str_replace(':amoureux', '<img src="./images/smileys/amoureux.gif" title="amoureux" alt="amoureux" />', $texte);
	$texte = str_replace(':ange', '<img src="./images/smileys/ange.gif" title="ange" alt="ange" />', $texte);
	$texte = str_replace(':angry ', '<img src="./images/smileys/angry.gif" title="angry" alt="angry" />', $texte);
	$texte = str_replace(':blink ', '<img src="./images/smileys/blink.gif" title="blink" alt="blink" />', $texte);
	$texte = str_replace(':diable', '<img src="./images/smileys/diable.gif" title="diable" alt="diable" />', $texte);
	$texte = str_replace(':fouetaie', '<img src="./images/smileys/fouetaie.gif" title="fouetaie" alt="fouetaie" />', $texte);
	$texte = str_replace(':magicien', '<img src="./images/smileys/magicien.gif" title="magicien" alt="magicien" />', $texte);
	$texte = str_replace(':mechant', '<img src="./images/smileys/mechant.gif" title="mechant" alt="mechant" />', $texte);
	$texte = str_replace(':ninja', '<img src="./images/smileys/ninja.gif" title="ninja" alt="ninja" />', $texte);
	$texte = str_replace(':pinch', '<img src="./images/smileys/pinch.gif" title="pinch" alt="pinch" />', $texte);
	$texte = str_replace(':pirate', '<img src="./images/smileys/pirate.gif" title="pirate" alt="pirate" />', $texte);
	$texte = str_replace(':pleure', '<img src="./images/smileys/pleure.gif" title="pleure" alt="pleure" />', $texte);
	$texte = str_replace(':rouge', '<img src="./images/smileys/rouge.gif" title="rouge" alt="rouge" />', $texte);
	$texte = str_replace(':zorro', '<img src="./images/smileys/zorro.gif" title="zorro" alt="zorro" />', $texte);
	$texte = str_replace(':pfff', '<img src="./images/smileys/hallo.gif" title="hallo" alt="hallo" />', $texte);
	$texte = str_replace(':tutu', '<img src="./images/smileys/hallo2.gif" title="hallo" alt="hallo" />', $texte);
	$texte = str_replace(':soldat', '<img src="./images/smileys/soldat.gif" title="soldat" alt="soldat" />', $texte);
	
	//Mise en forme du texte
	//gras
	$texte = preg_replace('`\[g\](.+)\[/g\]`isU', '<strong>$1</strong>', $texte); 
	//italique
	$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
	//souligné
	$texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $texte);
	//lien
	$texte = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
	//etc., etc.
	//On retourne la variable texte
	return $texte;
}
?>