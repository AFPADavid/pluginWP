<?php
/**
 * Plugin Name: Fabrice_Plugin_V2
 * Plugin URI: http://URL_de_l_extension
 * Description: Plugin Test de FABRICE.
 * Version: 1.5
 * Author: Fabrice LE BLANC
 * Author URI: http://fbrc.esy.es
 * License: (lien de la licence)
 */


//Création de la fonction "Ajouter au menu"
 function Fabrice_Plugin_V2_ajouterLesPages() {
    $page = "Fabrice-Plugin-V2";
    $menu = "Fabrice-Plugin-V2";
    $capacity = "edit_pages";
    $slug = "Fabrice_Plugin_V2";
    $function = "Fabrice_Plugin_V2_Fonction";
    $icon = "";
    $position = 80; // L'entrée dans le menu sera juste en dessous de "Réglages"
    if (is_admin()) {
        // Ajoute la page et rend visible le lien dans le menu
        add_menu_page($page, $menu, $capacity, $slug, $function, $icon, $position);
        // Ajoute 2 pages, elles seront accessibles via le MENU BS4 de la page principale
        // du plugin
      //   add_dashboard_page( 'Fabrice_Plugin_V2_Page2', 'Fabrice_Plugin_V2_Page2', 'edit_pages', 'fabrice_plugin_v2_page2', "Fabrice_Plugin_V2_affiche_page2" );
      //   add_dashboard_page( 'Fabrice_Plugin_V2_Configuration', 'Fabrice_Plugin_V2_Configuration', 'edit_pages', 'fabrice_plugin_v2_configuration', "Fabrice_Plugin_V2_affiche_config" );
      add_submenu_page( 'Fabrice_Plugin_V2' , 'Page2', 'Page2', 'edit_pages', 'fabrice_plugin_v2_page2', "Fabrice_Plugin_V2_affiche_page2" );
      add_submenu_page( 'Fabrice_Plugin_V2' , 'Configuration', 'Configuration', 'edit_pages', 'fabrice_plugin_v2_configuration', "Fabrice_Plugin_V2_affiche_config" );

      }
}

//Fonction à appeler lorsque l'on clique sur le menu
function Fabrice_Plugin_V2_Fonction() {
    require_once('views/Fabrice_Plugin_Main.php');
}

//Fonction à appeler lorsque l'on clique sur le lien dans le MENU BS4 de la page principale
function Fabrice_Plugin_V2_affiche_config() {
    include_once( 'views/Fabrice_Plugin_configuration.php'  );
 }


 //Fonction à appeler lorsque l'on clique sur le lien dans le MENU BS4 de la page principale
 function Fabrice_Plugin_V2_affiche_page2() {
    include_once( 'views/Fabrice_Plugin_Page2.php'  );
 } 

 function Fabrice_Plugin_V2_inserer_js_dans_footer() {
    if (is_admin()) {
       wp_register_script('jQuery', 
       'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js',
        null, null, true);
       wp_enqueue_script('jQuery');
       wp_register_script('popper', 
       'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', 
       null, null, true);
       wp_enqueue_script('popper');
       wp_register_script('BS4_JS', 
       'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js', 
       null, null, true);
       wp_enqueue_script('BS4_JS');
    }
}

function Fabrice_Plugin_V2_ajouter_css() {
   if (is_admin()) :
       wp_register_style('BS4_CSS', 
       'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css', 
       null, null, false);
       wp_enqueue_style('BS4_CSS');
   endif;
}


  // hook pour réaliser l'action 'admin_menu'
 add_action("admin_menu", "Fabrice_Plugin_V2_ajouterLesPages");
 
 // Ajout du CSS et JS BS4 dans les pages
 add_action('admin_head-toplevel_page_Fabrice_Plugin_V2', 'Fabrice_Plugin_V2_ajouter_css');
 add_action('admin_head-fabrice-plugin-v2_page_fabrice_plugin_v2_page2', 'Fabrice_Plugin_V2_ajouter_css');
 add_action('admin_head-fabrice-plugin-v2_page_fabrice_plugin_v2_configuration', 'Fabrice_Plugin_V2_ajouter_css');
 add_action('admin_head-toplevel_page_Fabrice_Plugin_V2', 'Fabrice_Plugin_V2_inserer_js_dans_footer');
 add_action('admin_head-fabrice-plugin-v2_page_fabrice_plugin_v2_page2', 'Fabrice_Plugin_V2_inserer_js_dans_footer');
 add_action('admin_head-fabrice-plugin-v2_page_fabrice_plugin_v2_configuration', 'Fabrice_Plugin_V2_inserer_js_dans_footer');


////////////   Pour connaitre le {$hook_suffix} de chacune des pages
//  add_action( 'admin_notices', 'wps_print_admin_pagehook' );
//  function wps_print_admin_pagehook(){
//      global $hook_suffix;
//      if( !current_user_can( 'manage_options') )
//          return;
//      echo "<div class='error'><p>
//              $hook_suffix 
//             </p></div>";
//  }

?>

 



 

 

