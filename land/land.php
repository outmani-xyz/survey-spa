<?php
$landDir = plugin_dir_url(__FILE__) . '/';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $entreprise = $_POST['entreprise'];
    $secteur_activite = implode(',', $_POST['secteur_activite']);
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
    $result = $wpdb->insert(
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
    if ($result != false) {

        $from_mail = get_option('admin_email');
//    $blogname=get_option( 'blogname' );
        $to = $email;
        $subject = 'Email de confirmation ';
        $body = 'Vos informations ont bien été prises en compte.<br>
Nous serons ravis de vous accueillir lors du Sirha Hall 6 – Stand 6E06<br>
Au plaisir de vous y retrouver<br>
L’équipe JDE';
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: L’équipe JDE <wordpress@pushnotify.xyz> ' /* . $from_mail */
        ];
//            $message = "Votre demande d'inscription a bien été prise en compte. Vous recevrez d'ici peu une confirmation par email";

        if (wp_mail($to, $subject, $body, $headers)) {
            $message = "Votre demande d'inscription a bien été prise en compte. Vous recevrez d'ici peu une confirmation par email";
        } else {
            $message = ":'( Error Ressayer Une Autre Fois";
        }
    }
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="<?= $landDir; ?>css/bootstrap.min.css">

        <link rel="stylesheet" href="<?= $landDir; ?>css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?= $landDir; ?>css/main.css">

        <!--<script src="<?= $landDir; ?>js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 visible-md visible-lg no-padding">
                    <p class="bigp">Afin de mieux vous accueillir sur notre stand, nous vous remercions de bien vouloir renseigner
                        ce questionnaire.
                    </p>
                </div>
                <div class="col-md-8 bigimg">
                </div>

                <div class="col-md-4 sm-xs-p hidden-md hidden-lg">
                    <p class="p">Afin de mieux vous accueillir sur notre stand, nous vous remercions de bien vouloir renseigner
                        ce questionnaire.
                    </p>
                </div>
            </div>
            <form method="post" action="">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2  col-sm-10 col-sm-offset-1 ">
                        <h2 class="text-center">COORDONNÉES</h2>
                        <div class="form-group">                         
                            <input class="form-control" required="" name="nom" type="text" placeholder="Nom">
                        </div>
                        <div class="form-group"> 
                            <input class="form-control" required="" name="prenom" type="text" placeholder="Prénom">
                        </div>
                        <div class="form-group"> 
                            <input class="form-control" required="" name="email" type="email" placeholder="E-mail">
                        </div>
                        <div class="form-group"> 
                            <input class="form-control" required="" name="mobile" type="tel" placeholder="Mobile">
                        </div>
                        <div class="form-group"> 
                            <input class="form-control" name="entreprise" type="text" placeholder="Entreprise">
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <h2 class="text-center">SECTEUR D’ACTIVITÉ</h2>
                    <div class="col-md-12">
                        <div class="col-md-4 col-sm-6 col-xs-6">

                            <div class="form-group">
                                <p>Restauration commerciale</p>
                                <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="secteur_activite[]" value="Restauration commerciale" class="checkbox"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">

                            <div class="form-group">
                                <p>Boulangerie-Pâtisserie</p>
                                <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="secteur_activite[]" value="Boulangerie-Pâtisserie" class="checkbox"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">

                            <div class="form-group">
                                <p>Distributeurs-Grossistes</p>
                                <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="secteur_activite[]" value="Distributeurs-Grossistes" class="checkbox"/>
                            </div>
                        </div>
                        <!--                        <div class="col-md-4 col-sm-6 col-xs-6">
                        
                                                    <div class="form-group">
                                                        <p>Restauration commercial</p>
                                                        <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="restauration_commercial" value="Restauration commercial" class="checkbox"/>
                                                    </div>
                                                </div>-->
                        <div class="col-md-4 col-sm-6 col-xs-6">

                            <div class="form-group">
                                <p>Fabricants de matériel </p>
                                    
                                <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="secteur_activite[]" value="fabricants de matériel" class="checkbox"/>
                                
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">

                            <div class="form-group">
                                <p> Industrie Agro-alimentaire </p>
                                <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="secteur_activite[]" value="Industrie Agro-alimentaire" class="checkbox"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">

                            <div class="form-group">
                                <p>Métiers de bouche</p>
                                <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="secteur_activite[]" value="Métiers de bouche" class="checkbox"/>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-6">
                            <div class="col-md-6 col-xs-12">
                                <p>Restauration collective </p>
                                <label class="btn  btn-checkbox"> <input type="checkbox" autocomplete="off"  name="secteur_activite[] " value="Restauration collective " class="checkbox"/>
                            </div>
                            <div class="col-md-6 col-xs-12">                                   
                                <p style="margin:auto;">Autres (précisez)</p>
                                <input type="text" placeholder="autre.." name="autre" value="" class="form-control"/>
                            </div> 
                        </div>
                    </div>
                </div>
                <!--  oui/no section begin -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <h4>Souhaitez-vous rencontrer l’un de nos représentants sur le salon ?*</h4>
                                <p>*Si oui, nous prendrons rendez-vous préalablement avec vous par téléphone.</p>
                            </div>
                            <div class="col-md-3">
                                <div class="" data-toggle="buttons">
                                    <label class="btn-square btn  active">
                                        <input type="radio" name="rencontre" autocomplete="off" value="oui" checked> oui 
                                    </label>
                                    <label class="btn-square btn ">
                                        <input type="radio" name="rencontre" value="no" autocomplete="off"> no
                                    </label> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <h4>Souhaitez-vous recevoir de la documentation sur nos solutions ?	</h4>
                            </div>
                            <div class="col-md-3">
                                <div class="" data-toggle="buttons">
                                    <label class="btn-square btn  active">
                                        <input type="radio" name="recevoir_doc" autocomplete="off" value="oui" checked> oui 
                                    </label>
                                    <label class="btn-square btn ">
                                        <input type="radio" name="recevoir_doc" value="no" autocomplete="off"> no
                                    </label> 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4>Si OUI, pourriez-vous préciser vos besoins ?</h4>
                                    <textarea class="form-control" name="besoins"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <h4> Souhaitez-vous participer à un de nos ateliers Barista ?</h4>
                            </div>
                            <div class="col-md-3"> 
                                <div class="" data-toggle="buttons">
                                    <label class="btn-square btn  active">
                                        <input type="radio" name="participe" autocomplete="off" value="oui" checked> oui 
                                    </label>
                                    <label class="btn-square btn ">
                                        <input type="radio" name="participe" value="no" autocomplete="off"> no
                                    </label> 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                <h4>Merci d’indiquer un créneau préféré</h4>
                            </div>
                            <div class="col-md-3">
                                <input  type="date" name="creneau" class="form-control"> 
                            </div>
                        </div> 

                        <div class="form-group text-center">
                            <br>
                            <button type="submit" name="submit" value="save" class="btn-flt btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                </div>
                <!--  oui/no section begin -->
            </form>
            <div class="row row-dwn">
                <div class="col-md-12 col-dow">
                    <!--<img src="<?= $landDir; ?>img/sirha.jpg" class="img-responsive center-block">-->
                </div>
            </div>
            <footer class="row row-dwn">
                <div class="col-md-12">
                    <div class=" col-md-6 col-sm-6 col-xs-6">
                        <img src="<?= $landDir; ?>img/coffee.png" class="pull-left img-responsive "></div>
                        <div class=" col-md-6 col-sm-6 col-xs-6">
                            <img src="<?= $landDir; ?>img/jde.png" class="pull-right img-responsive"></div>
                        </div>                
                        </footer>
                    </div> 
                    <!-- /container -->   
                    <!-- model fade in after insert begin -->

                    <!-- Modal -->
                    <div id="myModal"  class="modal fade <?= (isset($message)) ? "in" : ""; ?>" role="dialog" style=" <?= (isset($message)) ? "display:block; padding-left: 17px;background: rgba(0, 0, 0, 0.58);" : "display:none"; ?>;">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 style="color:#000" class="modal-title">Message</h4>
                                </div>
                                <div class="modal-body">
                                    <p style="color:#000"><?= (isset($message)) ? $message : ""; ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="document.getElementById('myModal').style.display = 'none'" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- model fade in after insert end -->
                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                    <script>window.jQuery || document.write('<script src="<?= $landDir; ?>js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

                    <script src="<?= $landDir; ?>js/vendor/bootstrap.min.js"></script>

                    <script src="<?= $landDir; ?>js/main.js"></script>
                    <!-- ads exit begin--> 

                    <!-- ads exit end-->
                    </body>
                    </html>
