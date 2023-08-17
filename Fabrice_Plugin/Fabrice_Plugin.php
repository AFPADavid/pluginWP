<?php
/**
 * Plugin Name: Fabrice_Plugin
 * Plugin URI: http://URL_de_l_extension
 * Description: Plugin Test de FABRICE.
 * Version: 1.5
 * Author: Fabrice LE BLANC
 * Author URI: http://fbrc.esy.es
 * License: (lien de la licence)
 */


//Création de la fonction "Ajouter au menu"
 function Fabrice_Plugin_ajouterLesPages() {
    $page = "Fabrice-Plugin";
    $menu = "Fabrice-Plugin";
    $capacity = "edit_pages";
    $slug = "Fabrice_Plugin";
    $function = "Fabrice_Plugin_Fonction";
    $icon = "";
    $position = 80; // L'entrée dans le menu sera juste en dessous de "Réglages"
    if (is_admin()) {
        // Ajoute la page et rend visible le lien dans le menu
        add_menu_page($page, $menu, $capacity, $slug, $function, $icon, $position);
        // Ajoute 2 pages, elles seront accessibles via le MENU BS4 de la page principale
        // du plugin
        // add_dashboard_page( 'Page2', 'Page2', 'edit_pages', 'fabrice_plugin_page2', "Fabrice_Plugin_affiche_page2", 80);
        // add_dashboard_page( 'Configuration', 'Configuration', 'edit_pages', 'fabrice_plugin_configuration', "Fabrice_Plugin_affiche_config", 80 );
        add_submenu_page( 'Fabrice_Plugin' , 'Page2', 'Page2', 'edit_pages', 'fabrice_plugin_page2', "Fabrice_Plugin_affiche_page2");
        add_submenu_page( 'Fabrice_Plugin' , 'Configuration', 'Configuration', 'edit_pages', 'fabrice_plugin_configuration', "Fabrice_Plugin_affiche_config");
    }
}

//Fonction à appeler lorsque l'on clique sur le menu
function Fabrice_Plugin_Fonction() {
    require_once('views/Fabrice_Plugin_Main.php');
}

//Fonction à appeler lorsque l'on clique sur le lien dans le MENU BS4 de la page principale
function Fabrice_Plugin_affiche_config() {
    include_once( 'views/Fabrice_Plugin_configuration.php'  );
 }


 //Fonction à appeler lorsque l'on clique sur le lien dans le MENU BS4 de la page principale
 function Fabrice_Plugin_affiche_page2() {
    include_once( 'views/Fabrice_Plugin_Page2.php'  );
 } 

  // hook pour réaliser l'action 'admin_menu'
 add_action("admin_menu", "Fabrice_Plugin_ajouterLesPages", 80);
 

 

 



 

 

