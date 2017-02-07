<?php

function outm_survey_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "outm_survey";
    $id = $_GET["id"];
//update
    if (isset($_POST['update'])) { 
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $entreprise = $_POST['entreprise'];
        $secteur_activite = (isset($_POST['secteur_activite'])) ? implode(',', $_POST['secteur_activite']) : "";
//        
//    echo '<pre>';    echo $secteur_activite;
//    echo '</pre>';
        $autre = $_POST['autre'];
        $rencontre = $_POST['rencontre'];
        $recevoir_doc = $_POST['recevoir_doc'];
        $besoins = $_POST['besoins'];
        $participe = $_POST['participe'];
        $creneau = $_POST['creneau'];
        $wpdb->update(
                $table_name, //table
                ['nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mobile' => $mobile,
            'entreprise' => $entreprise,
            'secteur_activite' => $secteur_activite,
            'autre' => $autre,
            'rencontre' => $rencontre,
            'recevoir_doc' => $recevoir_doc,
            'besoins' => $besoins,
            'participe' => $participe,
            'creneau' => $creneau], //data
                ['id' => $id], //where
                ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'], //data format
                ['%s'] //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $client = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
        foreach ($client as $c) {
            $row = $c;
            $secteur = explode(",", $row->secteur_activite);
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/outmani.xyz/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Client</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Client deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=outm_survey_list') ?>">&laquo; Back tolist</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Client updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=outm_survey_list') ?>">&laquo; Back to list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

                <table class='wp-list-table widefat fixed'>
                    <tr>
                        <th class="ss-th-width">nom</th>
                        <td>                      
                            <input class="form-control" name="nom" type="text" value="<?= $row->nom ?>" placeholder="Nom">
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">prenom</th>
                        <td>                      
                            <input class="form-control" name="prenom" value="<?= $row->prenom ?>" type="text" placeholder="prenom">
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">email</th>
                        <td>                      
                            <input class="form-control" name="email" value="<?= $row->email ?>" type="email" placeholder="email">
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">mobile</th>
                        <td>                      
                            <input class="form-control" name="mobile" type="text" value="<?= $row->mobile ?>" placeholder="mobile">
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">entreprise</th>
                        <td>                      
                            <input class="form-control" name="entreprise" type="text" value="<?= $row->entreprise ?>" placeholder="entreprise">
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">SECTEUR D’ACTIVITÉ</th>
                        <td>       
                            <select name="secteur_activite[]" multiple="multiple">
                                <option value="Restauration commercial" <?= (in_array("Restauration commercial", $secteur)) ? "selected" : ""; ?> >Restauration commercial</option>
                                <option value="Boulangerie-Pâtisserie" <?= (in_array("Boulangerie-Pâtisserie", $secteur)) ? "selected" : ""; ?> >Boulangerie-Pâtisserie</option>
                                <option value="Distributeurs-Grossistes" <?= (in_array("Distributeurs-Grossistes", $secteur)) ? "selected" : ""; ?> >Distributeurs-Grossistes</option>
                                <option value="Fabricants de matériel" <?= (in_array("Fabricants de matériel", $secteur)) ? "selected" : ""; ?> >Fabricants de matériel</option>
                                <option value="Industrie Agro-alimentaire" <?= (in_array("Industrie Agro-alimentaire", $secteur)) ? "selected" : ""; ?> >Industrie Agro-alimentaire</option>
                                <option value="Métiers de bouche" <?= (in_array("Métiers de bouche", $secteur)) ? "selected" : ""; ?> >Métiers de bouche</option>
                                <option value="Restauration collective" <?= (in_array("Restauration collective", $secteur)) ? "selected" : ""; ?> >Restauration collective</option>
                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">autre</th>
                        <td>                      
                            <input class="form-control" name="autre" type="text" value="<?= $row->autre ?>" placeholder="Autres (précisez)">
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">Souhaitez-vous rencontrer l’un de nos représentants</th>
                        <td>                      
                            <label>oui</label> <input type="radio" name="rencontre" value="oui" <?= ($row->rencontre == "oui") ? "checked" : ""; ?>/>
                            <label>no</label>   <input type="radio" name="rencontre" value="no" <?= ($row->rencontre == "no") ? "checked" : ""; ?> />                  
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">Souhaitez-vous recevoir de la documentation </th>
                        <td>                      
                            <label>oui</label>   <input type="radio" name="recevoir_doc" value="oui" <?= ($row->recevoir_doc == "oui") ? "checked" : ""; ?>/>
                            <label>no</label>   <input type="radio" name="recevoir_doc" value="no"  <?= ($row->recevoir_doc == "no") ? "checked" : ""; ?>/>
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">Si OUI, pourriez-vous préciser vos besoins ?</th>
                        <td> 
                            <textarea name="besoins"><?= $row->besoins ?></textarea>
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">Souhaitez-vous participer à un de nos ateliers </th>
                        <td>    
                            <label>oui</label>   <input type="radio" name="participe" value="oui"  <?= ($row->participe == "oui") ? "checked" : ""; ?>/>
                            <label>no</label>  <input type="radio" name="participe" value="no"  <?= ($row->participe == "no") ? "checked" : ""; ?>/>                  
                        </td>
                    </tr> 
                    <tr>
                        <th class="ss-th-width">
                            Merci d’indiquer un créneau préféré
                        </th>
                        <td>    
                            <input type="date" name="creneau" value="<?= $row->creneau ?>"/>                 
                        </td>
                    </tr> 
                </table> 
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('confirmer la supression')">
            </form>
        <?php } ?>

    </div>
    <?php
}
