
<?php include("Forum/includes/debut.php"); ?>

<body>

<div id="content_register">
<div id="fond_register" style="background-image: url(images/fonds/7.jpg)">

<?php

$url='http://www.youtube.com/rss/user/bwf/videos.rss';

    $root = simplexml_load_file($url);
    $videos = array();
    $i = 0;

	
    foreach($root->channel->item as $video)
    {
       $videos[$i]['titleFull'] = trim($video->title);
        //$videos[$i]['title'] = ($this->videos[$i]['titleFull'], 22);
        $videos[$i]['link'] = trim($video->link);
		$videos[$i]['link'] = str_replace("&feature=youtube_gdata","", $videos[$i]['link']);
		$videos[$i]['link'] = str_replace("watch?","", $videos[$i]['link']);
		$videos[$i]['link'] = str_replace("=","/", $videos[$i]['link']);
		echo '<center><div class="titre_news"><img src="images/logos/volant1.jpg" style="height:30px;margin-left:10px;"><a style="color:white;margin-left:10px;font-size:25px;font-family:Calibri;">'.$videos[$i]['titleFull'] = trim($video->title).'</a></div></center>';
		?>
		
			
<center><embed width="800" height="450" src="<?php echo $videos[$i]['link']; ?>" type="application/x-shockwave-flash" style="margin-top:10px;border:7px solid #2a2a2a;border-style:inset;margin-bottom:25px;"> </embed></center>
	<?php
		echo '</br>';
        $dateTime = new DateTime($video->pubDate, new DateTimeZone('Europe/Paris'));
        $videos[$i]['date'] = $dateTime->format('\l\e d/m/Y \à H:i:s');
        $i++;
		if($i==5) break;
    }


?>

</div>
</div>
</body>