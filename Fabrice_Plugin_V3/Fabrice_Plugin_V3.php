<?php
/**
 * Plugin Name: Fabrice_Plugin_V3
 * Plugin URI: http://URL_de_l_extension
 * Description: Plugin de FABRICE avec : Plusieurs Pages + téléchargement de fichiers image. Pour les afficher sur une PAGE ou un ARTICLE, il suffit d'utiliser le SHORTCODE : [fabrice-plugin-v3]
 * Version: 1.5
 * Author: Fabrice LE BLANC
 * Author URI: http://fbrc.esy.es
 * License: (lien de la licence)
 */


//Création de la fonction "Ajouter au menu"
 function Fabrice_Plugin_V3_ajouterLesPages() {
    $page = "Fabrice-Plugin-V3";
    $menu = "Fabrice-Plugin-V3";
    $capacity = "edit_pages";
    $slug = "Fabrice_Plugin_V3";
    $function = "Fabrice_Plugin_V3_Fonction";
    $icon = "";
    $position = 80; // L'entrée dans le menu sera juste en dessous de "Réglages"
    if (is_admin()) {
        // Ajoute la page et rend visible le lien dans le menu
        add_menu_page($page, $menu, $capacity, $slug, $function, $icon, $position);
        // Ajoute 2 pages, elles seront accessibles via le MENU BS4 de la page principale
        // du plugin
      add_submenu_page( 'Fabrice_Plugin_V3' , 'Gestion Images', 'Gestion Images', 'edit_pages', 'fabrice_plugin_v3_gestion_images', "Fabrice_Plugin_V3_Gestion_Images" );
      add_submenu_page( 'Fabrice_Plugin_V3' , 'Configuration', 'Configuration', 'edit_pages', 'fabrice_plugin_v3_configuration', "Fabrice_Plugin_V3_affiche_config" );

      }
}

//Fonction à appeler lorsque l'on clique sur le menu
function Fabrice_Plugin_V3_Fonction() {
    require_once('views/Fabrice_Plugin_Main.php');
}

//Fonction à appeler lorsque l'on clique sur le lien dans le MENU BS4 de la page principale
function Fabrice_Plugin_V3_affiche_config() {
    include_once( 'views/Fabrice_Plugin_configuration.php'  );
 }


 //Fonction à appeler lorsque l'on clique sur le lien dans le MENU BS4 de la page principale
 function Fabrice_Plugin_V3_Gestion_Images() {
    include_once( 'views/Fabrice_Plugin_Gestion_Images.php'  );
 } 

 function Fabrice_Plugin_V3_inserer_js_dans_footer() {
   //  if (is_admin()) {
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
   //  }
}

function Fabrice_Plugin_V3_ajouter_css() {
   // if (is_admin()) :
       wp_register_style('BS4_CSS', 
       'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css', 
       null, null, false);
       wp_enqueue_style('BS4_CSS');
   // endif;
}




  // hook pour réaliser l'action 'admin_menu'
 add_action("admin_menu", "Fabrice_Plugin_V3_ajouterLesPages");
 
 // Ajout du CSS et JS BS4 dans les pages ADMIN
 add_action('admin_head-toplevel_page_Fabrice_Plugin_V3', 'Fabrice_Plugin_V3_ajouter_css');
 add_action('admin_head-fabrice-plugin-v3_page_fabrice_plugin_v3_gestion_images', 'Fabrice_Plugin_V3_ajouter_css');
 add_action('admin_head-fabrice-plugin-v3_page_fabrice_plugin_v3_configuration', 'Fabrice_Plugin_V3_ajouter_css');
 add_action('admin_head-toplevel_page_Fabrice_Plugin_V3', 'Fabrice_Plugin_V3_inserer_js_dans_footer');
 add_action('admin_head-fabrice-plugin-v3_page_fabrice_plugin_v3_gestion_images', 'Fabrice_Plugin_V3_inserer_js_dans_footer');
 add_action('admin_head-fabrice-plugin-v3_page_fabrice_plugin_v3_configuration', 'Fabrice_Plugin_V3_inserer_js_dans_footer');


 // Ajout de BS4 dans les pages PUBLIC
 add_action('init', 'Fabrice_Plugin_V3_inserer_js_dans_footer');
 add_action('wp_head', 'Fabrice_Plugin_V3_ajouter_css',1);

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


/////////////////////////////////////////////////////////////////////
//////////     Gestion lors de la désactivation                //////
/////////////////////////////////////////////////////////////////////

register_deactivation_hook(__FILE__, 'Fabrice_Plugin_V3_supprimerFichiersImages');
function Fabrice_Plugin_V3_supprimerFichiersImages() {
   // Folder path to be flushed
   $repertoire = plugin_dir_path(__FILE__) . "\assets\images\\";
      
   // List of name of files inside
   // specified folder
   $files = glob($repertoire.'/*'); 
      
   // Deleting all the files in the list
   foreach($files as $file) {
      
      if(is_file($file)) 
      
         // Delete the given file
         unlink($file); 
   }
}


///////    Le shortcode pour générer l'affichage des images    /////
add_shortcode('fabrice-plugin-v3', 'Fabrice_Plugin_V3_afficheImages');

function Fabrice_Plugin_V3_afficheImages() {
   ////////////    Affichage des images dans un TABLEAU Simple   /////////////////////
   //  $resultat = "<button class='btn btn-success'>Test</button><table class='table table-dark table-hover'>";
   //  $repertoire = plugin_dir_path(__FILE__) . "assets\images\\";
   //  $url_images = plugin_dir_url( dirname(__FILE__)) . 'Fabrice_Plugin_V3/assets/images/';
     
   //  $myfiles = array_diff(scandir($repertoire), array('.', '..')); 
   //  foreach($myfiles as $filename){
   //      $resultat .= "<tr><td><img src=$url_images$filename class='img-thumbnail' width='200' height='200'/></tr></td>";
   //  }
   //  $resultat .= "</table>";
   //  return $resultat;

   ////////////    Affichage des images dans un Cards DECK BS4   /////////////////////
   $resultat = "<div class='card-deck'>";
   $repertoire = plugin_dir_path(__FILE__) . "assets\images\\";
   $url_images = plugin_dir_url( dirname(__FILE__)) . 'Fabrice_Plugin_V3/assets/images/';
    
   $myfiles = array_diff(scandir($repertoire), array('.', '..')); 
   foreach($myfiles as $filename){
       $resultat .= "<div class='card bg-primary'>
                        <div class='card-body'>
                           <img src=$url_images$filename class='img-thumbnail' width='200' height='200'/>
                        </div>
                     </div>";
   }
   $resultat .= "</div>";
   return $resultat;
}

 




