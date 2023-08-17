<?php
    ///  Affiche la liste des fichiers déjà présents dans assets/images
    function Fabrice_Plugin_V3_affiche_liste_images() {
        $repertoire = plugin_dir_path(__FILE__) . "..\assets\images\\";
        $url_images = plugin_dir_url( dirname(__FILE__)) . 'assets/images/';
        // $repertoire = plugin_dir_path(__FILE__) . "assets\images/";
        $myfiles = array_diff(scandir($repertoire), array('.', '..')); 
    
        $resultat = "<div class='table-responsive'><table class='table table-dark table-hover'>";
        $resultat .= "<tr><th>Image</th><th>Nom du fichier</th><th>Action</th></tr>"; 
        foreach($myfiles as $filename){
            $resultat .= "<tr><td><img src=$url_images$filename class='img-thumbnail' width='50' height='50'/> </td><td> $filename </td><td> X </td></tr>";
        }
        $resultat .= "</table></div>";
        
    return $resultat; 
    }



    // Incorporer Header (BS4 + Barre de NAV)
    require_once('Fabrice_Plugin_Menu.php');

    $repertoire = plugin_dir_path(__FILE__) . "..\assets\images/";
    if (isset($_POST['nom_fichier'])) {

        if (($_FILES['fichier']['name']!="")){
            // Where the file is going to be stored
            $target_dir =  $repertoire;
            $file = $_FILES['fichier']['name'];
            $path = pathinfo($file);
            //$filename = $path['filename'];
            $filename = $_POST['nom_fichier'];
            $ext = $path['extension'];
            $temp_name = $_FILES['fichier']['tmp_name'];
            $path_filename_ext = $target_dir.$filename.".".$ext;
            
            // Check if file already exists
            if (file_exists($path_filename_ext)) {
                echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Attention!</strong> Un fichier déjà enregistré avec ce nom
                </div>";
            }else{
                move_uploaded_file($temp_name,$path_filename_ext);
                echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Bravo!</strong> Un fichier bien copié. 
            </div>";
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Attention!</strong> Un fichier non reçu
            </div>";
        }
    }

    // Recupération de la liste des images
    $strListeImages = Fabrice_Plugin_V3_affiche_liste_images();

    
?>
<div class="container-fluid">

    <h1>Gestion des images</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fichier">Choisir une image :</label>
            <input type="file" class="form-control"
                    id="fichier" name="fichier"
                    accept="image/png, image/jpeg">

            <label for="nom_fichier">Nom de l'image :</label>
            <input type="text" class="form-control" id="nom_fichier" name="nom_fichier" required />
            
        </div>
        <div class="btn-group">
            <input type="submit" class='btn btn-success' value='Enregister' />
            <button type="reset" class='btn btn-warning'>Annuler</button>
        </div>
    </form>
    <div><?php echo @$strListeImages; ?></div>

</div>
 