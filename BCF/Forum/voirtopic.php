<?php
session_start();
?>
<body style="background-color:black;">
<div id="body_image" style="background-image: url(../images/fonds/4.jpg);">
<center><a style="color:white;font-size:120px;">Forum</a></center>
<div id="content_register">
<div id="fond_register" style="background-image: url(../images/fonds/7.jpg)">

<?php
	include("includes/identifiants.php");
	include("includes/debut.php");
	//include("includes/bbcode.php"); //On verra plus tard ce qu'est ce fichier
	  
	//On r�cup�re la valeur de t
	$topic = (int) $_GET['t'];
	  
	//A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
	$query=$db->prepare('SELECT topic_titre, topic_post, forum_topic.forum_id, topic_last_post,
	forum_name, auth_view, auth_topic, auth_post 
	FROM forum_topic 
	LEFT JOIN forum_forum ON forum_topic.forum_id = forum_forum.forum_id 
	WHERE topic_id = :topic');
	$query->bindValue(':topic',$topic,PDO::PARAM_INT);
	$query->execute();
	$data=$query->fetch();
	$forum=$data['forum_id']; 
	$totalDesMessages = $data['topic_post'] + 1;
	$nombreDeMessagesParPage = 15;
	$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);

	echo '<p><i>Vous �tes ici</i> : <a style="color:#64dae2;" href="../index.php">Index du forum</a> => 
	<a style="color:#64dae2;" href="./voirforum.php?f='.$forum.'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
	 => <a style="color:#64dae2;" href="./voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>';
	 
	echo ' <div class="titre_news"><img src="../images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a></div>';
	echo ' <a href="deconnexion.php" style="margin-top:10px;color:#64dae2;float:right;"> D�connexion </a>';
	//Nombre de pages
	$page = (isset($_GET['page']))?intval($_GET['page']):1;
	 
	//On affiche les pages 1-2-3 etc...
	echo '<p style="color:#64dae2;" >Page : ';
	for ($i = 1 ; $i <= $nombreDePages ; $i++)
	{
		if ($i == $page) //On affiche pas la page actuelle en lien
		{
		echo $i;
		}
		else
		{
		echo '<a style="color:#64dae2;" href="voirtopic.php?t='.$topic.'&page='.$i.'">
		' . $i . '</a> ';
		}
	}
	echo'</p>';
	  
	$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
	 
	  
	//On affiche l'image r�pondre
	echo'<a href="./poster.php?action=repondre&amp;t='.$topic.'">
	<img src="images/7.gif" alt="R�pondre" title="R�pondre � ce topic" /></a>';
	  
	//On affiche l'image nouveau topic
	echo'<a href="./poster.php?action=nouveautopic&amp;f='.$data['forum_id'].'">
	<img src="images/6.gif" alt="Nouveau topic" title="Cr�er un nouveau topic" /></a>';
	$query->CloseCursor(); 
	//Enfin on commence la boucle !
	
	
	$query=$db->prepare('SELECT post_id , post_createur , post_texte , post_time ,
	membre_id, membre_pseudo, membre_inscrit, membre_avatar, membre_post, membre_signature
	FROM forum_post
	LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
	WHERE topic_id =:topic
	ORDER BY post_id
	LIMIT :premier, :nombre');
	$query->bindValue(':topic',$topic,PDO::PARAM_INT);
	$query->bindValue(':premier',(int) $premierMessageAafficher,PDO::PARAM_INT);
	$query->bindValue(':nombre',(int) $nombreDeMessagesParPage,PDO::PARAM_INT);
	$query->execute();
	  
	//On v�rifie que la requ�te a bien retourn� des messages
	if ($query->rowCount()<1)
	{
			echo'<p>Il n y a aucun post sur ce topic, v�rifiez l\'url et reessayez</p>';
	}
	else
	{
			//Si tout roule on affiche notre tableau puis on remplit avec une boucle
			?><table id="tab_forum">
			<tr>
			<th class="vt_auteur"><strong>Auteurs</strong></th>             
			<th class="vt_mess"><strong>Messages</strong></th>       
			</tr>
			<?php
			while ($data = $query->fetch())
			{
			//On commence � afficher le pseudo du cr�ateur du message :
			 //On v�rifie les droits du membre
			 //(partie du code comment�e plus tard)
			 echo'<tr><td><strong>
			 <a style="color:#64dae2;" href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">
			 '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></strong></td>';
				
			 /* Si on est l'auteur du message, on affiche des liens pour
			 Mod�rer celui-ci.
			 Les mod�rateurs pourront aussi le faire, il faudra donc revenir sur
			 ce code un peu plus tard ! */    
		
			 if ($id == $data['post_createur'])
			 {
			 echo'<td id=p_'.$data['post_id'].'>Post� � '.date('H\hi \l\e d M y',$data['post_time']).'
			 <a href="./poster.php?p='.$data['post_id'].'&amp;action=delete">
			 <img src="./images/supprimer.gif" alt="Supprimer"
			 title="Supprimer ce message" /></a>   
			 <a href="./poster.php?p='.$data['post_id'].'&amp;action=edit">
			 <img src="./images/editer.gif" alt="Editer"
			 title="Editer ce message" /></a></td></tr>';
			 }
			 else
			 {
			 echo'<td>
			 Post� � '.date('H\hi \l\e d M y',$data['post_time']).'
			 </td></tr>';
			 }
			
			 //D�tails sur le membre qui a post�
			 echo'<tr><td>
			 <img src="./images/avatars/'.$data['membre_avatar'].'" alt="" />
			 <br />Membre inscrit le '.date('d/m/Y',$data['membre_inscrit']).'
			 <br />Messages : '.$data['membre_post'].'<br />
			 </td>';
					
			 //Message
			 echo'<td>'.code(nl2br(stripslashes(htmlspecialchars($data['post_texte'])))).'
			 <br /><hr />'.code(nl2br(stripslashes(htmlspecialchars($data['membre_signature'])))).'</td></tr>';
			 } //Fin de la boucle ! \o/
			 $query->CloseCursor();
	 
			 ?>
	</table>
	<?php
			echo '<p style="color:#64dae2;" >Page : ';
			for ($i = 1 ; $i <= $nombreDePages ; $i++)
			{
					if ($i == $page) //On affiche pas la page actuelle en lien
					{
					echo $i;
					}
					else
					{
					echo '<a href="voirtopic.php?t='.$topic.'&amp;page='.$i.'">
					' . $i . '</a> ';
					}
			}
			echo'</p>';
			
			//On ajoute 1 au nombre de visites de ce topic
			$query=$db->prepare('UPDATE forum_topic
			SET topic_vu = topic_vu + 1 WHERE topic_id = :topic');
			$query->bindValue(':topic',$topic,PDO::PARAM_INT);
			$query->execute();
			$query->CloseCursor();
	 
	} //Fin du if qui v�rifiait si le topic contenait au moins un message
	?>          
</div>
</div>
</body>
</html>