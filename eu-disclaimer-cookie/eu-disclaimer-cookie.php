<?php
/**
 * Plugin Name: eu-disclaimer-cookie
 * Plugin URI: http://URL_de_l_extension
 * Description: Plugin sur la législation des produits à base de nicotine. Comment afficher le plugin ? Vous pouvez ajouter le shortcode [eu-disclaimer-cookie] dans un article ou une page
 * Version: 1.5
 * Author: David GRILLON
 * Author URI: http://afpa.fr
 * License: (lien de la licence)
 */

require_once("Model/Repository/DisclaimerGestionTable.php");

//Création de la fonction "Ajouter au menu"
 function ajouterAuMenu() {
    $page = "eu-disclaimer";
    $menu = "eu-disclaimer";
    $capacity = "edit_pages";
    $slug = "eu-disclaimer";
    $function = "disclaimerFonction";
    $icon = "";
    $position = 80; // L'entrée dans le menu sera juste en dessous de "Réglages"
    if (is_admin()) {
        add_menu_page($page, $menu, $capacity, $slug, $function, $icon, $position);
    }
}



if (class_exists("DisclaimerGestionTable")) {
    $gerer_table = new DisclaimerGestionTable();
} 
 
if (isset($gerer_table)) {
    // Création de la table en BDD lors de l'activation
    register_activation_hook(__FILE__, array($gerer_table, 'creerTable')); 
    // Suppression de la table en BDD lors de la désactivation
    register_deactivation_hook(__FILE__, array($gerer_table, 'supprimerTable'));

}
 
 

 // hook pour réaliser l'action 'admin_menu'
 add_action("admin_menu", "ajouterAuMenu", 10);

//Fonction à appeler lorsque l'on clique sur le menu
function disclaimerFonction() {
    require_once('views/disclaimer-menu.php');
}


 add_action('init', 'inserer_js_dans_footer');

 function inserer_js_dans_footer() {
    if (!is_admin()) :
       wp_register_script('jQuery', 
       'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
        null, null, true);
       wp_enqueue_script('jQuery');
       wp_register_script('jQuery_modal', 
       'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js', 
       null, null, true);
       wp_enqueue_script('jQuery_modal');
       wp_register_script('jQuery_eu', 
    //    plugins_url('assets/js/eu-disclaimer.js', __FILE__), 
    //    array('jquery'), '1.1', true);
       plugins_url('assets/js/eu-disclaimer-cookie.js', __FILE__), 
       null, null, true);
       wp_enqueue_script('jQuery_eu');
    endif;
 }

 add_action('wp_head', 'ajouter_css',1);

 function ajouter_css() {
    if (!is_admin()) :
        wp_register_style('eu-disclaimer-css', 
        plugins_url('assets/css/eu-disclaimer-css-cookie.css', __FILE__), 
        null, null, false);
        wp_enqueue_style('eu-disclaimer-css');
        wp_register_style('modal', 
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css', 
        null, null, false);
        wp_enqueue_style('modal');
    endif;
 }
/////////////////////////////////////////////
/////////////  Affichage      ///////////////
/////////////  systématique   ///////////////
/////////////////////////////////////////////
 add_action('wp_body_open', 'afficheModalDansBody');

 function afficheModalDansBody() {
    echo DisclaimerGestionTable::AfficherDonneModal();
}

/////////////////////////////////////////////
/////////////  Affichage      ///////////////
/////////////  via SHORTCODE  ///////////////
/////////////////////////////////////////////
//  Pour afficher la MODAL, il suffit  //////
// d'ajouter [eu-disclaimer] dans le   //////
// contenu d'une page / Article        //////
/////////////////////////////////////////////
 add_shortcode('eu-disclaimer-cookie', 'afficheModal');

 function afficheModal() {
     return DisclaimerGestionTable::AfficherDonneModal();
 }




 

 

