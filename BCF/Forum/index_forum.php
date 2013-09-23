<?php
include_once("includes/identifiants.php");
include_once("includes/debut.php");
?>

<div id="content_register">
	<div id="fond_register" style="background-image: url(images/fonds/7.jpg)">
	<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">Bienvenue sur le forum du BCF</a></div>
		<?php // echo '$ses_id = '.$_SESSION['id']; ?>
		<div>
			<form method="post" action="Forum/connexion.php">
			<div id="connect">
				<fieldset>
				<legend style="color:white;font-size:15px;">Connexion</legend>
				<table>
				<tr>
				<td><label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /></td>
				<td><label for="password">Mot de Passe :</label><input type="password" name="password" id="password" /></td>
				</tr>
				<tr><td><input type="submit" value="Connexion"/></td></tr>
				</table>
				<!-- <p>
				<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
				<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
				</p>
				<label>Se souvenir de moi ?</label><input type="checkbox" name="souvenir" /><br /> -->
				</fieldset>
				</form>
				<br />
				<a href="Forum/register.php" style="color:#37becb;">Pas encore inscrit ?</a>
			</div>
		</div>

		<div>
			<?php
			//Initialisation de deux variables
			$totaldesmessages = 0;
			$categorie = NULL;

			//Cette requête permet d'obtenir tout sur le forum
			$query=$db->prepare('SELECT cat_id, cat_nom, 
			forum_forum.forum_id, forum_name, forum_desc, forum_post, forum_topic, auth_view, forum_topic.topic_id, forum_topic.topic_post, post_id, post_time, post_createur, membre_pseudo, 
			membre_id 
			FROM forum_categorie
			LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id
			LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id
			LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
			LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
			WHERE auth_view <= :lvl 
			ORDER BY cat_ordre, forum_ordre DESC');
			$query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
			$query->execute();
			?>
			<table id="tab_forum">
			<?php
			//Début de la boucle
			while($data = $query->fetch())
			{
				//On affiche chaque catégorie
				if( $categorie != $data['cat_id'] )
				{
					$categorie = $data['cat_id'];
					?>
					<tr>
					<th class="arrondi_gauche"></th>
					<th class="titre"><strong><?php echo stripslashes(htmlspecialchars($data['cat_nom'])); ?>
					</strong></th>             
					<th class="nombremessages"><strong>Sujets</strong></th>       
					<th class="nombresujets"><strong>Messages</strong></th>       
					<th class="derniermessage2"><strong>Dernier message</strong></th>   
					</tr>
					<?php          
				}
			  
				echo'<tr><td><img style="height:50px;" src="Forum/images/tableau/8.png" alt="message" /></td>
				<td class="titre"><strong>
				<a style="color:#64dae2;" href="Forum/voirforum.php?f='.$data['forum_id'].'">
				'.stripslashes(htmlspecialchars($data['forum_name'])).'</a></strong>
				<br />'.nl2br(stripslashes(htmlspecialchars($data['forum_desc']))).'</td>
				<td class="nombresujets">'.$data['forum_topic'].'</td>
				<td class="nombremessages">'.$data['forum_post'].'</td>';
			 
				// Deux cas possibles :
				// Soit il y a un nouveau message, soit le forum est vide
				if (!empty($data['forum_post']))
				{
					 //Selection dernier message
				 $nombreDeMessagesParPage = 15;
					 $nbr_post = $data['topic_post'] +1;
				 $page = ceil($nbr_post / $nombreDeMessagesParPage);
					  
					 echo'<td class="derniermessage">
					 '.date('H\hi \l\e d/M/Y',$data['post_time']).'<br />
					 <a href="./voirprofil.php?m='.stripslashes(htmlspecialchars($data['membre_id'])).'&amp;action=consulter">'.$data['membre_pseudo'].'  </a>
					 <a href="./voirtopic.php?t='.$data['topic_id'].'&amp;page='.$page.'#p_'.$data['post_id'].'">
					 <img src="./images/go.gif" alt="go" /></a></td></tr>';
			 
				 }
				 else
				 {
					 echo'<td class="nombremessages">Pas de message</td></tr>';
				 }
			 
				 //Cette variable stock le nombre de messages, on la met à jour
				 $totaldesmessages += $data['forum_post'];
			 
			} 
			$query->CloseCursor();
			
			echo '</table>
			</div>';


			//Le pied de page ici :
			echo'<div id="footer_forum">
			<h2 style="margin-left:50px;"> Qui est en ligne ? </h2>
			';
			 
			//On compte les membres
			$TotalDesMembres = $db->query('SELECT COUNT(*) FROM forum_membres')->fetchColumn();
			$query->CloseCursor();   
			$query = $db->query('SELECT membre_pseudo, membre_id FROM forum_membres ORDER BY membre_id DESC LIMIT 0, 1');
			$data = $query->fetch();
			$derniermembre = stripslashes(htmlspecialchars($data['membre_pseudo']));
			 
			echo'<p>Le total des messages du forum est <strong style="color:white;">'.$totaldesmessages.'</strong>.<br />';
			echo'Le site et le forum comptent <strong style="color:white;">'.$TotalDesMembres.'</strong> membres.<br />';
			echo'Le dernier membre est <a style="color:white;" href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">'.$derniermembre.'</a>.</p>';
			$query->CloseCursor();
			?>

		</div>
	</div>
</div>
</body>
</html>