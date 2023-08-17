<?php


    if (!empty($_POST['message_disclaimer']) && !empty($_POST['url_redirection'])) {
        $text = new DisclaimerOptions();
        $text->setMessage_disclaimer(htmlspecialchars($_POST['message_disclaimer']));
        $text->setRedirection_ko(htmlspecialchars($_POST['url_redirection']));
        DisclaimerGestionTable::insererDansTable($text->getMessage_disclaimer(), $text->getRedirection_ko());
        $message = "Mise à jour bien effectuée";
    }

    global $wpdb;
    $query = "SELECT * from " . $wpdb->prefix."disclaimer_options";
    $row = $wpdb->get_row($query);
    $message_disclaimer = $row->message_disclaimer;
    $lien_redirection = $row->redirection_ko;
?>


<h1>EU DISCLAIMER</h1>
<br/>
<h2>Configuration</h2>
<p><?php echo @$message; ?></p>
<form method="post" action="" novalidate="novalidate">
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="message_disclaimer">Message du disclaimer</label>
            </th>
            <td>
                <input type="text" name="message_disclaimer" id="message_disclaimer" value="<?php echo @$message_disclaimer; ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="url_redirection">Url de redirection</label>
            </th>
            <td>
                <input type="text" name="url_redirection" id="url_redirection" value="<?php echo @$lien_redirection; ?>" class="regular-text" />
            </td>
        </tr>
    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Enregistrer les modififcations" />
    </p>
</form>
<br/>
ACTUELLEMENT dans la BDD<br/>
Message dans la BDD : <?php echo @$message_disclaimer; ?>
<br/>
Lien dans la BDD : <?php echo @$lien_redirection; ?>
<p>
    Exemple : La législation nous impose de vous informer sur la nocivité des produits à base de nicotine, 
    vous devez avoir plus de 18 ans pour consulter ce site !
</p>
<br/>
<h3>
    Centre AFPA / session DWWM
</h3>
<img src="<?php echo plugin_dir_url( dirname(__FILE__)) . 'assets/img/layout_set_logo.jpg'; ?>" width="10%" />
<p>
Comment afficher le plugin ? <br/>
Vous pouvez ajouter le shortcode [eu-disclaimer-cookie] dans un article ou une page
</p>