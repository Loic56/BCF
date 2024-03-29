<?php
// on inclut la classe magpierss
require_once("magpierss/rss_fetch.inc");
 
// la fonction FeedParser() va extraire le contenu pour l'afficher
// elle prend en param�tre $url_feed, l'url du flux RSS et $nb_items_affiches, le 
//nombre d'�l�ments (items) � afficher

function FeedParser($url_feed, $nb_items_affiches) {
 
    // lecture du fichier distant (flux XML)
    $rss = fetch_rss($url_feed);
 
    // si le parcours du fichier se passe bien, on lit les �lements (items)
    if (is_array($rss->items))  {
 
        // on ne garde que les $nb_items_affiches premiers �l�ments (items), 
//nombre d�fini dans l'en-t�te de la fonction
        $items = array_slice($rss->items, 0, $nb_items_affiches);
 
        // on peut r�cup�rer les informations sur le site proposant le flux (optionnel)
        $site_titre = $rss->channel["title"]; // titre du site
        $site_lien = $rss->channel["link"]; // lien du site
        $site_description = $rss->channel["description"]; // description du site   
 
        // � pr�sent on stocke les donn�es dans $html, variable � afficher
		$html="";
        // titre sous forme de lien
        $html .= "<a href=\"$site_lien\" title=\"$site_description\" target=\"_blank\"> $site_titre</a><br />\n";
 
        // on affiche la description du site proposant le flux
        $html .= "<span>$site_description</span><br clear=\"left\" target=\"_blank\"> <br />\n"; 
		// le clear="left" renvoie � la ligne m�me s'il y a une image
 
        // on fait une boucle sur les informations : pour chaque item, r�cup�rer $titre... et afficher
        foreach($items as $item) {
 
            // on m�morise les informations de chaque item dans des variables
            $titre = $item["title"];
            $lien = $item["link"];
            $description = $item["description"];
 
 
            // la date utilis�e pour les flux RSS est au format timestamp, il faut  donc formater la date
            // conversion au format jj/mm/aa. pour plus d'informations, vous conf�rer au tutorial sur les timestamp
            $date = date("d/m/y",strtotime($item["pubdate"]));         
 
            // on affiche le titre de chaque item
            $html .= "<a href=\"".$lien."\" title=\"".$titre."\" target=\"_blank\"> ".$titre."</a><br>\n";
 
            // puis la date et la description
            $html .= "<span>$date - $description</span><br clear=\"left\"><br />\n";
        } // fin de la boucle
 
        // on retourne la variable $html au programme (elle contient le code HTML 
		//	pour l'affichage du flux)
        return $html;
    } // fin du traitement du fichier
} // fin de la fonction FeedParser()
?>



