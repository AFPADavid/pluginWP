<?php


    if (!empty($_POST['message_disclaimer']) && !empty($_POST['url_redirection'])) {
        $text = new DisclaimerOptions();
        $text->setMessage_disclaimer($_POST['message_disclaimer']);
        $text->setRedirection_ko($_POST['url_redirection']);
        DisclaimerGestionTable::insererDansTable($text->getMessage_disclaimer(), $text->getRedirection_ko());
    }
?>


<h1>EU DISCLAIMER</h1>
<br/>
<h2>Configuration</h2>
<p></p>
<form method="post" action="" novalidate="novalidate">
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="message_disclaimer">Message du disclaimer</label>
            </th>
            <td>
                <input type="text" name="message_disclaimer" id="message_disclaimer" value="" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="url_redirection">Url de redirection</label>
            </th>
            <td>
                <input type="text" name="url_redirection" id="url_redirection" value="" class="regular-text" />
            </td>
        </tr>
    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Enregistrer les modififcations" />
    </p>
</form>
<br/>
<p>
    Exemple : La législation nous impose de vous informer sur la nocivité des produits à base de nicotine, 
    vous devez avoir plus de 18 ans pour consulter ce site !
</p>
<br/>
<h3>
    Centre AFPA / session DWWM
</h3>
<img src="<?php echo plugin_dir_url( dirname(__FILE__)) . 'assets/img/layout_set_logo.jpg'; ?>" width="10%" />