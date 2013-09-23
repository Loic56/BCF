<?php
session_start();
?>
<body style="background-color:black;">
<div id="body_image" style="background-image: url(../images/fonds/4.jpg);">
<center><a style="color:white;font-size:120px;">Forum</a></center>
<div id="content_register" >
	<div id="fond_postok" style="background-image: url(../images/fonds/7.jpg)">
	
<?php

$titre="Poster";
include("includes/identifiants.php");
include("includes/debut.php");

//On r�cup�re la valeur de la variable action
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';


// Si le membre n'est pas connect�, il est arriv� ici par erreur
if ($id==0) erreur(ERR_IS_CO);

switch($action)
{
    //Premier cas : nouveau topic
    case "nouveautopic":
    //On passe le message dans une s�rie de fonction
    $message = $_POST['message'];
	//echo 'message :'.$message;
	//echo '</br>';
    $mess = $_POST['mess'];
	//echo $mess;
	//echo '</br>';
    //Pareil pour le titre
    $titre = $_POST['titre'];
	//echo 'titre :'.$titre;
	//echo '</br>';
	
    //ici seulement, maintenant qu'on est sur qu'elle existe, on r�cup�re la valeur de la variable f
    $forum = (int) $_GET['f'];
    $temps = time();
 
    if (empty($message) || empty($titre))
    {
        echo'<p>Votre message ou votre titre est vide, 
        cliquez <a href="./poster.php?action=nouveautopic&amp;f='.$forum.'">ici</a> pour recommencer</p>';
    }
    else //Si jamais le message n'est pas vide
    {//On entre le topic dans la base de donn�e en laissant
        //le champ topic_last_post � 0
	/*	echo $forum;
		echo '</br>';
			echo $titre;
			echo '</br>';
				echo $id;
				echo '</br>';
					echo $temps;
					echo '</br>';
						echo $mess; // */
		
	/* 	echo 'INSERT INTO forum_topic
        (forum_id, topic_titre, topic_createur, topic_vu, topic_time, topic_genre)
        VALUES('.$forum.', '.$titre.', '.$id.', 1, '.$temps.', '.$mess.')'; // */
		
		
        $query=$db->prepare('INSERT INTO forum_topic
        (forum_id, topic_titre, topic_createur, topic_vu, topic_time, topic_genre)
        VALUES(:forum, :titre, :id, 1, :temps, :mess)');
        $query->bindValue(':forum', $forum, PDO::PARAM_INT);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':temps', $temps, PDO::PARAM_INT);
        $query->bindValue(':mess', $mess, PDO::PARAM_STR);
        $query->execute();
 
 
        $nouveautopic = $db->lastInsertId(); //Notre fameuse fonction !
        $query->CloseCursor(); 
 
        //Puis on entre le message
        $query=$db->prepare('INSERT INTO forum_post
        (post_createur, post_texte, post_time, topic_id, post_forum_id)
        VALUES (:id, :mess, :temps, :nouveautopic, :forum)');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':mess', $message, PDO::PARAM_STR);
        $query->bindValue(':temps', $temps,PDO::PARAM_INT);
        $query->bindValue(':nouveautopic', (int) $nouveautopic, PDO::PARAM_INT);
        $query->bindValue(':forum', $forum, PDO::PARAM_INT);
        $query->execute();
 
 
        $nouveaupost = $db->lastInsertId(); //Encore notre fameuse fonction !
        $query->CloseCursor(); 
 
 
        //Ici on update comme pr�vu la valeur de topic_last_post et de topic_first_post
        $query=$db->prepare('UPDATE forum_topic
        SET topic_last_post = :nouveaupost,
        topic_first_post = :nouveaupost
        WHERE topic_id = :nouveautopic');
        $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);    
        $query->bindValue(':nouveautopic', (int) $nouveautopic, PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
 
        //Enfin on met � jour les tables forum_forum et forum_membres
        $query=$db->prepare('UPDATE forum_forum SET forum_post = forum_post + 1 ,forum_topic = forum_topic + 1, 
        forum_last_post_id = :nouveaupost
        WHERE forum_id = :forum');
        $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);    
        $query->bindValue(':forum', (int) $forum, PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
     
        $query=$db->prepare('UPDATE forum_membres SET membre_post = membre_post + 1 WHERE membre_id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);    
        $query->execute();
        $query->CloseCursor();
 
        //Et un petit message
        echo'<p>Votre message a bien �t� ajout�!<br /><br />Cliquez <a href="./index.php">ici</a> pour revenir � l index du forum<br />
        Cliquez <a href="./voirtopic.php?t='.$nouveautopic.'">ici</a> pour le voir</p>';
    }
    break; //Houra !
	
	//Deuxi�me cas : r�pondre
    case "repondre":
    $message = $_POST['message'];
 
    //ici seulement, maintenant qu'on est sur qu'elle existe, on r�cup�re la valeur de la variable t
    $topic = (int) $_GET['t'];
    $temps = time();
 
    if (empty($message))
    {
        echo'<p>Votre message est vide, cliquez <a href="./poster.php?action=repondre&amp;t='.$topic.'">ici</a> pour recommencer</p>';
    }
    else //Sinon, si le message n'est pas vide
    {
 
        //On r�cup�re l'id du forum
        $query=$db->prepare('SELECT forum_id, topic_post FROM forum_topic WHERE topic_id = :topic');
        $query->bindValue(':topic', $topic, PDO::PARAM_INT);    
        $query->execute();
        $data=$query->fetch();
        $forum = $data['forum_id'];
 
        //Puis on entre le message
        $query=$db->prepare('INSERT INTO forum_post
        (post_createur, post_texte, post_time, topic_id, post_forum_id)
        VALUES(:id,:mess,:temps,:topic,:forum)');
        $query->bindValue(':id', $id, PDO::PARAM_INT);   
        $query->bindValue(':mess', $message, PDO::PARAM_STR);  
        $query->bindValue(':temps', $temps, PDO::PARAM_INT);  
        $query->bindValue(':topic', $topic, PDO::PARAM_INT);   
        $query->bindValue(':forum', $forum, PDO::PARAM_INT); 
        $query->execute();
 
        $nouveaupost = $db->lastInsertId();
        $query->CloseCursor(); 
 
        //On change un peu la table forum_topic
        $query=$db->prepare('UPDATE forum_topic SET topic_post = topic_post + 1, topic_last_post = :nouveaupost WHERE topic_id =:topic');
        $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);   
        $query->bindValue(':topic', (int) $topic, PDO::PARAM_INT); 
        $query->execute();
        $query->CloseCursor(); 
 
        //Puis m�me combat sur les 2 autres tables
        $query=$db->prepare('UPDATE forum_forum SET forum_post = forum_post + 1 , forum_last_post_id = :nouveaupost WHERE forum_id = :forum');
        $query->bindValue(':nouveaupost', (int) $nouveaupost, PDO::PARAM_INT);   
        $query->bindValue(':forum', (int) $forum, PDO::PARAM_INT); 
        $query->execute();
        $query->CloseCursor(); 
 
        $query=$db->prepare('UPDATE forum_membres SET membre_post = membre_post + 1 WHERE membre_id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT); 
        $query->execute();
        $query->CloseCursor(); 
 
        //Et un petit message
        $nombreDeMessagesParPage = 15;
        $nbr_post = $data['topic_post']+1;
        $page = ceil($nbr_post / $nombreDeMessagesParPage);
        echo'<p>Votre message a bien �t� ajout�!<br /><br />
        Cliquez <a href="./index.php">ici</a> pour revenir � l index du forum<br />
        Cliquez <a href="./voirtopic.php?t='.$topic.'&amp;page='.$page.'#p_'.$nouveaupost.'">ici</a> pour le voir</p>';
    }//Fin du else
    break;
	
	default;
    echo'<p>Cette action est impossible</p>';
} //Fin du Switch
?>
</div>
</div>
</div>
</body>
</html>

