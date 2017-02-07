<?php

function loadBootstrap() {

    $plugindir = WP_PLUGIN_URL;
    wp_register_script('jquery-js', '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
    wp_register_script('bootstrap-js', $plugindir . '/outmani.xyz/land/js/vendor/bootstrap.min.js');
    wp_register_style('bootstrap-css', $plugindir . '/outmani.xyz/land/css/bootstrap.min.css');
    

    wp_register_script('dataTables-css', '//cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css');
    wp_register_script('dataTables-jqs', '//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js');
    wp_register_style('dataTables-js', '//cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js');

    wp_enqueue_script('jquery-js');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_style('bootstrap-css');
    

    wp_enqueue_script('dataTables-jqs');
    wp_enqueue_script('dataTables-js');
    wp_enqueue_style('dataTables-css');
}

add_action('admin_enqueue_scripts', 'loadBootstrap');

function outm_survey_list() {
    ?>
    <!--?php wp_enqueue_style(WP_PLUGIN_URL . 'style-admin.css'); ?-->
    <div class="wrap">
        <h2>Client</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=outm_survey_create'); ?>"><button>Add New</button></a>
                <!--<a href="<?php echo admin_url('admin.php?page=outm_survey_export'); ?>"><button>Eport</button></a>-->
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "outm_survey";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table id="tabledata" class="table table-striped table-bordered" data-page-length='10'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>email</th>
                    <th>mobile</th>
                    <th>SECTEUR D’ACTIVITÉ</th>
                    <th>autre</th>
                    <th>Souhaitez-vous rencontrer</th>
                    <th>Souhaitez-vous recevoir doc</th>
                    <th>besoins</th>
                    <th>participer</th>
                    <th>créneau</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>email</th>
                    <th>mobile</th>
                    <th>SECTEUR D’ACTIVITÉ</th>
                    <th>autre</th>
                    <th>Souhaitez-vous rencontrer</th>
                    <th>Souhaitez-vous recevoir doc</th>
                    <th>besoins</th>
                    <th>participer</th>
                    <th>créneau</th>

                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td>
                            <?php echo $row->id; ?>
                            <br>
                            <a href="<?php echo admin_url('admin.php?page=outm_survey_update&id=' . $row->id); ?>">Update</a> 
                        </td>
                        <td><?php echo $row->nom; ?></td>
                        <td><?php echo $row->prenom; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->mobile; ?></td>
                        <td><?php echo $row->secteur_activite; ?></td>
                        <td><?php echo $row->autre; ?></td>
                        <td><?php echo $row->rencontre; ?></td>
                        <td><?php echo $row->recevoir_doc; ?></td>
                        <td><?php echo $row->besoins; ?></td>
                        <td><?php echo $row->participe; ?></td>
                        <td><?php echo $row->creneau; ?></td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                $('#tabledata').DataTable();
            });
        </script>
    </div>
    <?php
}
