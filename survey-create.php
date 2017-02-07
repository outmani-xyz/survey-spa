<?php

function outm_survey_create() {
    //insert
    if (isset($_POST['insert'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $entreprise = $_POST['entreprise'];
        $secteur_activite = (isset($_POST['secteur_activite'])) ? implode(',', $_POST['secteur_activite']) : "";
        $autre = $_POST['autre'];
        $rencontre = $_POST['rencontre'];
        $recevoir_doc = $_POST['recevoir_doc'];
        $besoins = $_POST['besoins'];
        $participe = $_POST['participe'];
        $creneau = $_POST['creneau'];
        global $wpdb;
        $table_name = $wpdb->prefix . "outm_survey";
//        echo '<pre>';
//        print_r($_POST);
//        echo '<pre>';
//        die;
        $wpdb->insert(
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
            'creneau' => $creneau
                ], //data
                ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'] //data format			
        );
        $message .= "Client survey created";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/outmani.xyz/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Client</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">nom</th>
                    <td>                      
                        <input required class="form-control" name="nom" type="text" placeholder="Nom">
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">prenom</th>
                    <td>                      
                        <input required class="form-control" name="prenom" type="text" placeholder="prenom">
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">email</th>
                    <td>                      
                        <input required class="form-control" name="email" type="text" placeholder="email">
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">mobile</th>
                    <td>                      
                        <input required class="form-control" name="mobile" type="text" placeholder="mobile">
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">entreprise</th>
                    <td>                      
                        <input required class="form-control" name="entreprise" type="text" placeholder="entreprise">
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">SECTEUR D’ACTIVITÉ</th>
                    <td>       
                        <select required="" name="secteur_activite[]" multiple="multiple">
                            <option value="Restauration commercial">Restauration commercial</option>
                            <option value="Boulangerie-Pâtisserie">Boulangerie-Pâtisserie</option>
                            <option value="Distributeurs-Grossistes">Distributeurs-Grossistes</option>
                            <option value="Fabricants de matériel">Fabricants de matériel</option>
                            <option value="Industrie Agro-alimentaire">Industrie Agro-alimentaire</option>
                            <option value="Métiers de bouche">Métiers de bouche</option>
                            <option value="Restauration collective">Restauration collective</option>
                        </select>
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">autre</th>
                    <td>                      
                        <input  class="form-control" name="autre" type="text" placeholder="Autres (précisez)">
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">Souhaitez-vous rencontrer l’un de nos représentants</th>
                    <td>                      
                        <label>oui</label> <input required type="radio" name="rencontre" value="oui"/>
                        <label>no</label>   <input required type="radio" name="rencontre" value="no"  />                  
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">Souhaitez-vous recevoir de la documentation </th>
                    <td>                      
                        <label>oui</label>   <input required type="radio" name="recevoir_doc" value="oui"/>
                        <label>no</label>   <input required type="radio" name="recevoir_doc" value="no"  />
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">Si OUI, pourriez-vous préciser vos besoins ?</th>
                    <td> 
                        <textarea name="besoins"></textarea>
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">Souhaitez-vous participer à un de nos ateliers </th>
                    <td>    
                        <label>oui</label>   <input required type="radio" name="participe" value="oui"/>
                        <label>no</label>  <input required type="radio" name="participe" value="no"  />                  
                    </td>
                </tr> 
                <tr>
                    <th class="ss-th-width">
                        Merci d’indiquer un créneau préféré
                    </th>
                    <td>    
                        <input  type="date" name="creneau"/>                 
                    </td>
                </tr> 
            </table>
            <input  type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}
