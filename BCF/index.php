<?php
//Cette fonction doit être appelée avant tout code html
session_start();

$GLOBALS['DEBUG_MODE'] = 0;
// CHANGE TO 0 TO TURN OFF DEBUG MODE
// IN DEBUG MODE, ONLY THE CAPTCHA CODE IS VALIDATED, AND NO EMAIL IS SENT
$GLOBALS['ct_recipient']   = 'loic.crusson@live.fr'; // Change to your email address!
$GLOBALS['ct_msg_subject'] = 'BCF - Demande de renseignements '; // */
include 'Forum/includes/functions.php';
$tab_news=recuperer_news();
?>

<!doctype html>
 
<html lang="en">
<head>
	<title>Site du BCF - Badminton Club Férel</title>
	
	<meta name="keywords" content="badminton, sports, loisirs, morbihan, 56, sud vilaine, férel, arzal, nivillac, marzan, club badminton" />
	<meta name="description" content="Club de badminton à Férel, BCF, 4 terrains, 70 adhérents. Catégories  Loisir, Libre et Jeunes. Championnat, ..." />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--  <link href="style.css" rel="stylesheet" media="all" type="text/css">   -->

	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src='fullcalendar/jquery/jquery-ui-1.10.2.custom.min.js'></script>
	<script src='fullcalendar/fullcalendar/fullcalendar.min.js'></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
	
	<link rel="stylesheet" href="js\jquery-ui-1.10.0.custom\jquery-ui-1.10.0.custom\development-bundle/themes/base/jquery.ui.all.css"> 
	<link rel="stylesheet" href="js\jquery-ui-1.10.0.custom\jquery-ui-1.10.0.custom\development-bundle\demos/demos.css">
	<link href='fullcalendar/fullcalendar/fullcalendar.css' rel='stylesheet' />
	<link href='fullcalendar/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />

</head>

<body style="background-color:black;">
	<!-- <div id="body"> -->

		<div id="body_image" style="background-image: url(images/fonds/4.jpg);">
 
			<div id="banniere">
				<div id="ban_top"></div>
				<div id="ban_center" style="background-image: url(images/fonds/9.jpg);">
					</a><img src="images/logos/2.jpg" style="height:110px;margin-right:75px;"><span>Badminton Club F&eacute;rel</span></a> 
				</div>
				<div id="ban_bottom"></div>
			</div>

			
			<center><p id="construct"> ! Site en construction !</p></center> 

	
			<div id="content">
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Accueil</a></li>
						<li><a href="#tabs-2">le club</a></li>
						<li><a href="#tabs-3">Cr&eacute;neaux horaires</a></li>
						<li><a href="#tabs-4">Forum</a></li>
						<li><a href="#tabs-5">Calendrier des tournois</a></li>
						<li><a href="#tabs-6">Photos</a></li>
						<li><a href="#tabs-7">ATP</a></li>
						<li><a href="#tabs-8">Vid&eacute;os - BWF</a></li>
						<li><a href="#tabs-9">Liens</a></li>
						<li><a href="#tabs-10">Contact</a></li>
						<li><a href="#tabs-11">Administration</a></li>
					</ul>
					
					<div id="tabs-1">  
						<div id="content_accueil" style="background-image: url(images/fonds/7.jpg);">
							<div id="container_principal">
								<div id="news">
									<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;"><?php echo $tab_news[0][1]; ?></a>
									<p style="color:#4be0f5;font-size:12px;margin-left:55px;"><?php echo $tab_news[0][4]; ?></p></div>
									<?php if(!empty($tab_news[0][3])){?>
											<center><img src="<?php echo $tab_news[0][3];?>" style="max-height:400px;margin-top:10px;max-width:700px;"></center>
									<?php } ?>	
									<fieldset style="margin-top:7px;border:1px solid grey;font-size:15px;"><p><?php echo $tab_news[0][2]; ?></p></fieldset>
								</div>
								
								<div class="news" id="news2">
									<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;"><?php echo $tab_news[1][1]; ?></a>
									<p style="color:#4be0f5;font-size:12px;margin-left:55px;"><?php echo $tab_news[2][4]; ?></p></div>
									<?php if(!empty($tab_news[1][3])){?>
											<center><img src="<?php echo $tab_news[1][3];?>" style="max-height:400px;margin-top:10px;max-width:700px;"></center>
									<?php } ?>	
									<fieldset style="margin-top:7px;border:1px solid grey;"><p><?php echo $tab_news[1][2]; ?></p></fieldset>
								</div>
								
								<div class="news" id="news3">
									<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;"><?php echo $tab_news[2][1]; ?></a>
									<p style="color:#4be0f5;font-size:12px;margin-left:55px;"><?php echo $tab_news[2][4]; ?></p></div>
									<?php if(!empty($tab_news[2][3])){?>
											<center><img src="<?php echo $tab_news[2][3];?>" style="max-height:400px;margin-top:10px;max-width:700px;"></center>
									<?php } ?>	
									<fieldset style="margin-top:7px;border:1px solid grey;"><p><?php echo $tab_news[2][2]; ?></p></fieldset>
								</div>
								
								<div class="news" id="news4">
									<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;"><?php echo $tab_news[3][1]; ?></a>
									<p style="color:#4be0f5;font-size:12px;margin-left:55px;"><?php echo $tab_news[3][4]; ?></p></div>
									<?php if(!empty($tab_news[3][3])){?>
											<center><img src="<?php echo $tab_news[3][3];?>" style="max-height:400px;margin-top:10px;max-width:700px;"></center>
									<?php } ?>	
									<fieldset style="margin-top:7px;border:1px solid grey;"> <p> <?php echo $tab_news[3][2]; ?></p></fieldset>
								</div>
							</div>	<!-- container_principal -->
							
							<div id="container_droite">
								<div id="compteur_visite">
									<h2 style="color:white;text-align:center;">En ligne </h2>
									<?php include 'connectes.php';?>
									<br />
									<?php include 'compteur_visites.php';?>
								</div>
								
								<div id="rss_badmania">
									<h2 style="color:#0a96c6;text-align:center;">Newsletter Badmania </h2>
									<?php
										try{
										if(!@$fluxrss=simplexml_load_file('http://badmania.fr/flux/rss.xml')){ throw new Exception('Flux introuvable');}
										if(empty($fluxrss->channel->title) && empty($fluxrss->channel->description) &&empty($fluxrss->channel->item->title)) throw new Exception('Flux invalide');
										$i=0;
										$nb_affichage = 5;
										echo '<ul style="width:270px;padding:3px;list-style-type:none; color:white;">';
										foreach($fluxrss->channel->item as $item){
										echo '<li style="max-width:430px; color:white;"><a style="color:#4be0f5;" href="'.(string)$item->link.'">'.(string)$item->title.'</a><p>'.(string)$item->description.'</p> <i>publi&eacute; le'.(string)date('d/m/Y à G\hi',strtotime($item->pubDate)).'</i></li>';
										if(++$i>=$nb_affichage)
										break;
										}
										echo '</ul>';
										}			
										catch(Exception $e){
										echo $e->getMessage();
										}
									?>
								</div>
							</div> <!-- container_droite -->
							
						</div><!-- content_accueil -->
					</div><!-- tabs-1 -->
				


					<div id="tabs-2"> 
						<div class="tab_container"  style="background-image: url(images/fonds/7.jpg)">
							<fieldset id="liseret2">
							<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">Pr&eacute;sentation</a></div>
								<fieldset style="margin-top:10px;padding:10px;">
								<h4 style="color:#96070c;">Le badminton Club F&eacute;rel a &eacute;t&eacute; fond&eacute; en 2002. Il propose une pratique du badminton en loisir. Il est ouvert &agrave; toute personne d&eacute;sirant pratiquer ce sport.</h4>
								<p>Les s&eacute;ances sont libres, chacun joue &agrave; son rythme, 
								avec des personnes de son niveau ou non. Il n'y a pas d'entra&icirc;neur, mais les plus exp&eacute;riment&eacute;s (merci &agrave; eux) conseillent les autres. 
								<br />En moyenne le nombre d'adh&eacute;rents approche la cinquantaine.</p>
								<p>Par ailleurs, un <strong>championnat loisir interclubs</strong> (Saint Malo de Guersac, Besn&eacute;, Herbignac, Sainte Reine, Saint Molf) est organis&eacute; pour les plus motiv&eacute;s depuis la saison 2008/09.</p>	
								<p>Les inscriptions sont ouvertes <strong>toute l'ann&eacute;e</strong>, moyennant un tarif d&eacute;gressif &agrave; compter du mois de janvier. Le club fournit les volants et pr&ecirc;tent des raquettes aux d&eacute;butants.</p>
								<p>Pour s'inscrire, il suffit, de compl&eacute;ter un <strong>formulaire</strong> que nous vous remettons lors de votre premier entra&icirc;nement, de fournir <strong>un num&eacute;ro de police d'assurance en responsabilit&eacute; civile</strong>, ainsi qu'un <strong>certificat de non contre-indication &agrave; la pratique du badminton</strong>.
								Le prix de la cotisation pour la saison 2012/13 s'&eacute;l&egrave;ve &agrave; <strong>35 EUR</strong> (30 EUR pour les jeunes, et 60 EUR pour deux inscriptions d'une m&ecirc;me famille).</p>
								<p>
								Par ailleurs, les mineurs accompagn&eacute;s d'un adulte peuvent venir jouer aux entra&icirc;nements des vendredis et samedis.
								Bureau et Contacts</p>
								<div style="float:left;width:500px;">
									<ul>
										<li>Pr&eacute;sidente : <strong>Ludivine Crusson</strong></li>
										<li>Pr&eacute;sidente adjointe : <strong>Anne Brochu</strong></li>
										<li>Tr&eacute;sorier : <strong>Golven Pocholle</strong></li>
										<li>Tr&eacute;sorier adjoint : <strong>Philippe Vrignaud</strong></li>
										<li>Secr&eacute;taire : <strong>Christophe Laffargue</strong></li>
										<li>Secr&eacute;taire adjointe : <strong>Gwena&euml;lle Perrin</strong></li>
									</ul>
									<p>Renseignements au : <strong>06 20 77 48 78</strong> ou <strong>06 61 75 95 84</strong></p>
								</div>
								<div id="div_carte"></div> 
								</fieldset>
							</fieldset>
						</div><!-- tab_container -->
					</div><!-- tabs-2 -->
				
				
					<div id="tabs-3"> 
						<div class="tab_container"  style="background-image: url(images/fonds/7.jpg)">
							<fieldset id="liseret2">
								<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;">
									<a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">Des horaires nombreux facilitant la pratique de tous</a>
								</div>
								<fieldset style="margin-top:10px;padding:10px;">
									<p> Les horaires des entra&icirc;nements s'&eacute;chelonnent sur toute la semaine :</p>
									<ul style="list-style:none;">
										<li>Mardi : 18h30 - 23h30</li>
										<li>Jeudi : 18h30 - 23h30</li>
										<li>Vendredi : 18h00 - 19h30</li>
										<li>Samedi : 9h00 - 12h00</li>
									</ul>
								</fieldset>
							</fieldset>
						</div><!-- tab_container -->
					</div><!-- tabs-3 -->
					
					<div id="tabs-4">  
						<?php
						 include_once('Forum/index_forum.php');
						?>
					</div><!-- tabs-4 -->
					
					
					<div id="tabs-5" > 
						<div id="content_register_calendar">
							<div id="fond_register_calendar" style="background-image: url(images/fonds/7.jpg)">
								<div id="calendar"></div>
							</div>
						</div>
					</div> <!-- tabs-5 -->
					
					
					<div id="tabs-6">  
						<div id="content_register">
							<div id="fond_register" style="background-image: url(images/fonds/7.jpg)">
								<h2> BCF - les photos </h2>
								
								<table id="tab_photo">
									<tr>
										<th style="width:10%;" class="arrondi_gauche"></th>
										<th style="width:45%;">Galerie </th>
										<th style="width:45%;" class="arrondi_droit">Description </th>
									</tr>
									<tr>
										<td><a href="galleria\themes\classic\galerie.html"><img src="images/img.jpg" class="vignette"></a></td>
										<td>2010-2011 : Le Bad masqu&eacute; du T&eacute;l&eacute;thon </td>
										<td>Description </td>
									</tr>	
									<tr>
										<td><a href="galery.html"><img src="images/img.jpg" class="vignette"></a></td>
										<td>2011-2012 : Le Bad masqu&eacute; du T&eacute;l&eacute;thon </td>
										<td>Description </td>
									</tr>	
									<tr>
										<td><a href="galery.html"><img src="images/img.jpg" class="vignette"></a></td>
										<td>2009-2010 : le tournoi v&eacute;t&eacute;ran </td>
										<td>Description </td>
									</tr>
								</table>
							</div><!-- fond_register -->
						</div><!-- content_register -->
					</div><!-- tabs-6 -->
					
					
					<div id="tabs-7"> 
						<iframe id="atp_view" src="http://www.bwfbadminton.org/page.aspx?id=14955" ></iframe>
					</div>
					
					
					<div id="tabs-8">
						<?php include 'BWF - TV.php'; ?>
					</div>
					
					
						
					<div id="tabs-9"> 
						<div id="content_register" >
							<div id="fond_register" style="background-image: url(images/fonds/7.jpg)">
								<table id="tab_liens">
									<tr><th class="arrondi_gauche"></th><th class="arrondi_droit"></th></tr>
									<tr>
										<td><a href="http://www.ffbad.org/" style="color:#64dae2;font-size:15px;">F&eacute;d&eacute;ration fran&ccedil;aise de badminton</a></td>
										<td><img src="images/logos/ffbad.png" style="width:150px; "></td>
									</tr>
										<tr>
										<td><a href="http://badmania.fr/" style="color:#64dae2;font-size:15px;">Badmania</a></td>
										<td><img src="images/logos/badmania.jpg" style="width:150px;"></td>
									</tr>
										<tr>
										<td><a href="http://www.lardesports.com/" style="color:#64dae2;font-size:15px;">Badaboum</a></td>
										<td><img src="images/logos/badaboum.jpg" style="width:150px;"></td>
									</tr>
								</table>
							</div><!-- fond_register -->
						</div><!-- content_register -->
					</div>	<!-- tabs-9 -->
							
				
					<div id="tabs-10">  
						<div class="tab_container"  style="background-image: url(images/fonds/7.jpg)" >
							<fieldset id="liseret2">
								 <?php
									process_si_contact_form(); // Process the form, if it was submitted
									if (isset($_SESSION['ctform']['error']) &&  $_SESSION['ctform']['error'] == true): ?>
									<span class="error">Il existe des erreurs dans le formulaire. Les erreurs sont &eacute;crites en rouge.</span><br /><br />
									<?php elseif (isset($_SESSION['ctform']['success']) && $_SESSION['ctform']['success'] == true): ?>
									<span class="success">Le message &agrave; &eacute;t&eacute; envoy&eacute; !</span><br /><br />
									<?php endif; 
								?>

								<form id="contact_form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']) ?>" id="contact_form">
									<input type="hidden" name="do" value="contact" />
									<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">Contact</a></div>
									
									<p>
									<strong>Nom*:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['name_error'] ?><br />
									<input class="bordure" type="text" id="ct_name" name="ct_name" size="35" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_name']) ?>" />
									</p>

									<p>
									<strong>Pr&eacute;nom*:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['name_error'] ?><br />
									<input class="bordure" type="text" id="ct_firstname" name="ct_firstname" size="35" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_name']) ?>" />
									</p>
									  
									<p>
									<strong>Email*:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['email_error'] ?><br />
									<input class="bordure" type="text" id="ct_email" name="ct_email" size="35" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_email']) ?>" />
									</p>

									<p>
									<strong>Message*:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['message_error'] ?><br />
									<textarea id="ct_message" name="ct_message" rows="12" cols="60"><?php echo htmlspecialchars(@$_SESSION['ctform']['ct_message']) ?></textarea>
									</p>

									<p>
									<img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
									<object type="application/x-shockwave-flash" data="securimage/securimage_play.swf?bgcol=#ffffff&amp;icon_file=securimage/images/audio_icon.png&amp;audio_file=securimage/securimage_play.php" height="32" width="32">
									<param name="movie" value="securimage/securimage_play.swf?bgcol=#ffffff&amp;icon_file=securimage/images/audio_icon.png&amp;audio_file=securimage/securimage_play.php" />
									</object>
										&nbsp;
									<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="securimage/images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />
									<strong>Entrer le Code*:</strong><br />
										 <?php echo @$_SESSION['ctform']['captcha_error'] ?>
									<input type="text" name="ct_captcha" size="12" maxlength="16" />
									</p>

									<p>
										<br />
										<input type="submit" value="Envoyer le message" onclick="resetFileds()"/>
									</p>

									<input type="hidden" name="selected_tab" id ="selected_tab">
						
								</form>
							</fieldset>
						</div> <!-- tab_container -->
					</div> <!-- tabs-10 -->
				
				
					<div id="tabs-11">  
						<form action="verification.php" method="post">
							<div class="tab_container"  style="background-image: url(images/fonds/7.jpg)">
								<fieldset id="liseret2">
									<div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">Identification</a></div>
									</br>
									<table style="margin-top:40px;">
										<tr>
										<td> Login: </td>
										<td> <input id="login" name="login" type="text" class="bordure"></td>
										</tr>
										<tr>
										<td> Password : </td>
										<td> <input id="pass" name="pass" type="text" class="bordure"></td>
										</tr>
									</table>
									</br>
									<input type="submit" value="Valider" onclick="identification()">
									<input type="hidden" value="admin">
								</fieldset>
							</div> <!-- tab_container -->
						</form>
					</div> <!-- tabs-11 -->
				
				
				</div> <!-- tabs -->
			</div> <!-- content -->
 
			<div id="footer" style="background-image: url(images/fonds/7.jpg);">
					<img src="images/logos/logo-bcf.jpg" style="height:60px;border:1px; float:left;">
			</div>
 
		</div> <!-- body_image -->
	<!-- </div> div body -->
	
<script>
  	$(document).ready(function(){
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var t = document.getElementById('news').offsetHeight;
		var t2 = document.getElementById('news2').offsetHeight;
		var t3 = document.getElementById('news3').offsetHeight;
		var t4 = document.getElementById('news4').offsetHeight;
		var taille = t+t2+t3+t4+130+"px";
		var taille2 = t+t2+t3+t4-100+"px";
		var taille3 = t+t2+t3+t4+240+"px";
		var taille4 = t+t2+t3+t4+700+"px";

		document.getElementById("content_accueil").style.height = taille;
		document.getElementById("rss_badmania").style.height = taille2;
		document.getElementById("content").style.height = taille3;
		document.getElementById("body_image").style.height = taille4;
		
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			events: [
				{
					title: 'Rencontre : Férel VS Sainte Reine',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					title: ' Rencontre Férel / Sainte reine ',
					start: new Date(y, m, d, 10, 32),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'My Event',
					start: new Date(y, m, 15, 12, 0),
					description: 'This is a cool event'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
		
		
		$(function() {
			$( "#tabs" ).tabs({active: <?php echo (isset($_POST['selected_tab']) ? 9 : 0) ?>});
		});
		
		
		$('#content').tabs().click(function(){
			document.getElementById("content_accueil").style.height = taille;
			document.getElementById("content").style.height = "auto";
			document.getElementById("content_register_calendar").style.height = taille_calendar;
		});

		
		function identification(){
		document.getElementById("identif").value = "ok";
		}
		
		
		function resetFileds(){
		document.getElementById('ct_message').value="";
		document.getElementById('ct_email').value="";
		document.getElementById('ct_firstname').value="";
		document.getElementById('ct_name').value="";
		document.getElementById('select1').selectedIndex=-1;
		}

		
		function initCarte(){ 
		// création de la carte 
		var oMap = new google.maps.Map( document.getElementById( 'div_carte'),{ 
		'center' : new google.maps.LatLng( 47.482342, -2.342812), 
		'zoom' : 15, 
		'mapTypeId' : google.maps.MapTypeId.ROADMAP 
		}); 
		} 
		// init lorsque la page est chargée 
		google.maps.event.addDomListener( window, 'load', initCarte); 
	});
</script>
  
<script>
    // Load the classic theme
    Galleria.loadTheme('galleria.classic.min.js');
    // Initialize Galleria
    Galleria.run('#galleria');

</script>

</body>
</html>





<?php
	// The form processor PHP code
	function process_si_contact_form()
	{
	  $_SESSION['ctform'] = array(); // re-initialize the form session data

	  if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'contact') {
		// if the form has been submitted

		foreach($_POST as $key => $value) {
		  if (!is_array($key)) {
			// sanitize the input data
			if ($key != 'ct_message') $value = strip_tags($value);
			$_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
		  }
		}

		$name    = @$_POST['ct_name'];    // name from the form
		$email   = @$_POST['ct_email'];   // email from the form
		$firstname = @$_POST['ct_firstname'];     // url from the form
		$message = @$_POST['ct_message']; // the message from the form
		$captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code
		$name    = substr($name, 0, 64);  // limit name to 64 characters

		$errors = array();  // initialize empty error array

		if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {
		  // only check for errors if the form is not in debug mode

		  if (strlen($name) < 3) {
			// name too short, add error
			$errors['name_error'] = 'Merci de remplir le champ \'nom\'';
		  }

		  if (strlen($firstname) < 2) {
			// name too short, add error
			$errors['name_error'] = 'Merci de remplir le champ \'prenom\'';
		  }
		  
		  if (strlen($email) == 0) {
			// no email address given
			$errors['email_error'] = 'Merci de remplir le champ \'Email\'';
		  } else if ( !preg_match('/^(?:[\w\d]+\.?)+@(?:(?:[\w\d]\-?)+\.)+\w{2,4}$/i', $email)) {
			// invalid email format
			$errors['email_error'] = 'L\'adresse Email est invalide';
		  }

		  if (strlen($message) < 20) {
			// message length too short
			$errors['message_error'] = 'Merci d\'entrer un message';
		  }
		}

		// Only try to validate the captcha if the form has no errors
		// This is especially important for ajax calls
		if (sizeof($errors) == 0) {
		  require_once dirname(__FILE__) . '/securimage/securimage.php';
		  $securimage = new Securimage();

		  if ($securimage->check($captcha) == false) {
			$errors['captcha_error'] = 'Code de s&eacute;curit&eacute; incorrect<br />';
		  }
		}

		if (sizeof($errors) == 0) {
		  // no errors, send the form
		  $time       = date('r');
		  $message = "A message was submitted from the contact form.  The following information was provided.<br /><br />"
						. "Nom: $name<br />"
						. "Prenom: $firstname<br />"
						. "Email: $email<br />"
						. "Message:<br />"
						. "<pre>$message</pre>"
						. "<br /><br />IP Address: {$_SERVER['REMOTE_ADDR']}<br />"
						. "Time: $time<br />"
						. "Browser: {$_SERVER['HTTP_USER_AGENT']}<br />";

		  $message = wordwrap($message, 70);

		 if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {
			mail($GLOBALS['ct_recipient'], $GLOBALS['ct_msg_subject'], $message, "From: {$GLOBALS['ct_recipient']}\r\nReply-To: {$email}\r\nContent-type: text/html; charset=ISO-8859-1\r\nMIME-Version: 1.0");
		  }

		  $_SESSION['ctform']['error'] = false;  // no error with form
		  $_SESSION['ctform']['success'] = true; // message sent
		} else {
		  // save the entries, this is to re-populate the form
		  $_SESSION['ctform']['ct_name'] = $name;       // save name from the form submission
		  $_SESSION['ctform']['ct_email'] = $email;     // save email
		  $_SESSION['ctform']['ct_message'] = $message; // save message

		  foreach($errors as $key => $error) {
			// set up error messages to display with each field
			$_SESSION['ctform'][$key] = "<span style=\"font-weight: bold; color: #f00\">$error</span>";
		  }

		  $_SESSION['ctform']['error'] = true; // set error floag
		}
	  } // POST
	}

	$_SESSION['ctform']['success'] = false; // clear success value after running
?>