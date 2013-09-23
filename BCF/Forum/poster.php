<?php
session_start();
?>

<body style="background-color:black;">
<div id="body_image" style="background-image: url(../images/fonds/4.jpg);">
<center><a style="color:white;font-size:120px;">Forum</a></center>
<div id="content_register" style="background-image: url(../images/fonds/7.jpg);">
<div id="fond_register">

<?php
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");


//Qu'est ce qu'on veut faire ? poster, répondre ou éditer ?
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

//Il faut être connecté pour poster !
if ($id==0) erreur(ERR_IS_CO);
 
//Si on veut poster un nouveau topic, la variable f se trouve dans l'url,
//On récupère certaines valeurs
if (isset($_GET['f']))
{
    $forum = (int) $_GET['f'];
    $query= $db->prepare('SELECT forum_id, forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_forum WHERE forum_id =:forum');
    $query->bindValue(':forum',$forum,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
    echo '<p><i>Vous êtes ici</i> : <a href="../index.php">Index </a> => 
    <a href="./voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    => Nouveau topic</p>';
}

  
//Sinon c'est un nouveau message, on a la variable t et
//On récupère f grâce à une requête
elseif (isset($_GET['t']))
{
    $topic = (int) $_GET['t'];
    $query=$db->prepare('SELECT topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_topic
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE topic_id =:topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
    $forum = $data['forum_id'];  
 
    echo '<p><i>Vous êtes ici</i> : <a href="../index_forum.php">Index </a> => 
    <a href="./voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    => <a href="./voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    => Répondre</p>';
}
  
//Enfin sinon c'est au sujet de la modération(on verra plus tard en détail)
//On ne connait que le post, il faut chercher le reste
elseif (isset ($_GET['p']))
{
    $post = (int) $_GET['p'];
    $query=$db->prepare('SELECT post_createur, forum_post.topic_id, topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_post
    LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE forum_post.post_id =:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
 
    $topic = $data['topic_id'];
	$topic = htmlentities($topic);
    $forum = $data['forum_id'];
  
    echo '<p><i>Vous êtes ici</i> : <a href="../index.php">Index </a> => 
    <a href="./voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    => <a href="./voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    => Modérer un message</p>';
}
$query->CloseCursor();  


switch($action)
{
case "repondre": //Premier cas on souhaite répondre
	?>
	<div class="titre_news"><img src="../images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">Répondre</a></div>
	<form method="post" action="postok.php?action=repondre&amp;t=<?php echo $topic ?>" name="formulaire"  style="margin-top:20px;">
		<fieldset><legend>Mise en forme</legend>
			<input type="button" id="gras" name="gras" value="Gras" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
			<input type="button" id="italic" name="italic" value="Italic" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
			<input type="button" id="souligné" name="souligné" value="Souligné" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
			<input type="button" id="lien" name="lien" value="Lien" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
			<br /><br />
			<img src="images/smileys/heureux.gif" title="heureux" alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
			<img class="space" src="images/smileys/triste.gif" title="triste" alt="triste" onClick="javascript:smilies(' :triste: ');return(false)" />
			<img class="space" src="images/smileys/cool.gif" title="cool" alt="cool" onClick="javascript:smilies(' :frime: ');return(false)" />
			<img class="space" src="images/smileys/rire.gif" title="rire" alt="rire" onClick="javascript:smilies(' XD ');return(false)" />
			<img class="space" src="images/smileys/siffle.gif" title="sifle" alt="sifle" onClick="javascript:smilies(' :siffle ');return(false)" />
			<img class="space" src="images/smileys/waw.gif" title="waw" alt="waw" onClick="javascript:smilies(' :o ');return(false)" />
			<img class="space" src="images/smileys/amoureux.gif" title="amoureux" alt="amoureux" onClick="javascript:smilies(' :amoureux ');return(false)" />
			<img class="space" src="images/smileys/ange.gif" title="ange" alt="ange" onClick="javascript:smilies(' :ange ');return(false)" />
			
			
			<img class="space" src="images/smileys/angry.gif" title="angry" alt="angry" onClick="javascript:smilies(' :angry ');return(false)" />
			<img class="space" src="images/smileys/blink.gif" title="blink" alt="blink" onClick="javascript:smilies(' :blink ');return(false)" />
			<img class="space" src="images/smileys/diable.gif" title="diable" alt="diable" onClick="javascript:smilies(' :diable ');return(false)" />
			<img class="space" src="images/smileys/fouetaie.gif" title="fouetaie" alt="fouetaie" onClick="javascript:smilies(' :fouetaie');return(false)" />
			<img class="space" src="images/smileys/magicien.gif" title="magicien" alt="magicien" onClick="javascript:smilies(' :magicien ');return(false)" />
			<img class="space" src="images/smileys/mechant.gif" title="mechant" alt="mechant" onClick="javascript:smilies(' :mechant ');return(false)" />
			<img class="space" src="images/smileys/ninja.gif" title="ninja" alt="ninja" onClick="javascript:smilies(' :ninja ');return(false)" />
			<img class="space" src="images/smileys/pinch.gif" title="pinch" alt="pinch" onClick="javascript:smilies(' :pinch ');return(false)" />
			<img class="space" src="images/smileys/pirate.gif" title="pirate" alt="pirate" onClick="javascript:smilies(' :pirate: ');return(false)" />
			<img class="space" src="images/smileys/pleure.gif" title="pleure" alt="pleure" onClick="javascript:smilies(' :pleure ');return(false)" />
			<img class="space" src="images/smileys/rouge.gif" title="rouge" alt="rouge" onClick="javascript:smilies(' :rouge ');return(false)" />
			<img class="space" src="images/smileys/zorro.gif" title="zorro" alt="zorro" onClick="javascript:smilies(' :zorro ');return(false)" />
			<img class="space" src="images/smileys/hallo.gif" title="hallo" alt="hallo" onClick="javascript:smilies(' :pfff ');return(false)" />
			<img class="space" src="images/smileys/hallo2.gif" title="hallo" alt="hallo" onClick="javascript:smilies(' :tutu ');return(false)" />
			<img class="space" src="images/smileys/soldat.gif" title="soldat" alt="soldat" onClick="javascript:smilies(' :soldat ');return(false)" />
		</fieldset>
	<fieldset><legend>Message</legend><textarea cols="80" rows="8" id="message" name="message"></textarea></fieldset>
	<input type="submit" name="submit" value="Envoyer" />
	<input type="reset" name = "Effacer" value = "Effacer"/>
	</p></form>
	<?php
break;
  
case "nouveautopic":
echo 'nouveau topic ';
	?>
	
	<div class="titre_news"><img src="../images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">Nouveau topic</a></div>
	<form method="post" action="postok.php?action=nouveautopic&amp;f=<?php echo $forum ?>" name="formulaire" style="margin-top:20px;">
	<fieldset><legend>Titre</legend>
	<input type="text" size="80" id="titre" name="titre" /></fieldset>
	  
	<fieldset><legend>Mise en forme</legend>
		<input type="button" id="gras" name="gras" value="Gras" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
		<input type="button" id="italic" name="italic" value="Italic" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
		<input type="button" id="souligné" name="souligné" value="Souligné" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
		<input type="button" id="lien" name="lien" value="Lien" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
		<br /><br />
			<img src="images/smileys/heureux.gif" title="heureux" alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
			<img class="space" src="images/smileys/triste.gif" title="triste" alt="triste" onClick="javascript:smilies(' :triste: ');return(false)" />
			<img class="space" src="images/smileys/cool.gif" title="cool" alt="cool" onClick="javascript:smilies(' :frime: ');return(false)" />
			<img class="space" src="images/smileys/rire.gif" title="rire" alt="rire" onClick="javascript:smilies(' XD ');return(false)" />
			<img class="space" src="images/smileys/siffle.gif" title="sifle" alt="sifle" onClick="javascript:smilies(' :s ');return(false)" />
			<img class="space" src="images/smileys/waw.gif" title="waw" alt="waw" onClick="javascript:smilies(' :o ');return(false)" />
			<img class="space" src="images/smileys/amoureux.gif" title="amoureux" alt="amoureux" onClick="javascript:smilies(' :amoureux ');return(false)" />
			<img class="space" src="images/smileys/ange.gif" title="ange" alt="ange" onClick="javascript:smilies(' :ange ');return(false)" />
			<img class="space" src="images/smileys/angry.gif" title="angry" alt="angry" onClick="javascript:smilies(' :angry ');return(false)" />
			<img class="space" src="images/smileys/blink.gif" title="blink" alt="blink" onClick="javascript:smilies(' :blink ');return(false)" />
			<img class="space" src="images/smileys/diable.gif" title="diable" alt="diable" onClick="javascript:smilies(' :diable ');return(false)" />
			<img class="space" src="images/smileys/fouetaie.gif" title="fouetaie" alt="fouetaie" onClick="javascript:smilies(' :fouetaie');return(false)" />
			<img class="space" src="images/smileys/magicien.gif" title="magicien" alt="magicien" onClick="javascript:smilies(' :magicien ');return(false)" />
			<img class="space" src="images/smileys/mechant.gif" title="mechant" alt="mechant" onClick="javascript:smilies(' :mechant ');return(false)" />
			<img class="space" src="images/smileys/ninja.gif" title="ninja" alt="ninja" onClick="javascript:smilies(' :ninja ');return(false)" />
			<img class="space" src="images/smileys/pinch.gif" title="pinch" alt="pinch" onClick="javascript:smilies(' :pinch ');return(false)" />
			<img class="space" src="images/smileys/pirate.gif" title="pirate" alt="pirate" onClick="javascript:smilies(' :pirate: ');return(false)" />
			<img class="space" src="images/smileys/pleure.gif" title="pleure" alt="pleure" onClick="javascript:smilies(' :pleure ');return(false)" />
			<img class="space" src="images/smileys/rouge.gif" title="rouge" alt="rouge" onClick="javascript:smilies(' :rouge ');return(false)" />
			<img class="space" src="images/smileys/zorro.gif" title="zorro" alt="zorro" onClick="javascript:smilies(' :zorro ');return(false)" />
			<img class="space" src="images/smileys/hallo.gif" title="hallo" alt="hallo" onClick="javascript:smilies(' :pfff ');return(false)" />
			<img class="space" src="images/smileys/hallo2.gif" title="hallo2" alt="hallo2" onClick="javascript:smilies(' :pfff2 ');return(false)" />
			<img class="space" src="images/smileys/soldat.gif" title="soldat" alt="soldat" onClick="javascript:smilies(' :soldat ');return(false)" />
			
	</fieldset>
	  
	<fieldset><legend>Message</legend>
	<textarea cols="80" rows="8" id="message" name="message"></textarea>
	<label><input type="radio" name="mess" value="Annonce" />Annonce</label>
	<label><input type="radio" name="mess" value="Message" checked="checked" />Topic</label>
	</fieldset>
	<p>
	<input type="submit" name="submit" value="Envoyer" />
	<input type="reset" name = "Effacer" value = "Effacer" /></p>
	</form>
	<?php
break;
  
//D'autres cas viendront s'ajouter ici par la suite

default: //Si jamais c'est aucun de ceux là c'est qu'il y a eu un problème :o
echo'<p>Cette action est impossible</p>';
} //Fin du switch
?>

</div>
</div>
</body>
</html>