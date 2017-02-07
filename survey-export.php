<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function outm_survey_export() {

    if (!is_super_admin()) {
        return;
    }
//	if ( ! isset( $_GET['bbg_export'] ) ) {
//		return;
//	}
    $filename = 'clients-' . time() . '.csv'; 
    global $wpdb;
    $table_name = $wpdb->prefix . "outm_survey";
    $header_row = [
        0 => 'id',
        2 => 'nom',
        3 => 'prenom',
        4 => 'email',
        5 => 'mobile',
        6 => 'entreprise',
        7 => 'secteur_activite',
        8 => 'autre',
        9 => 'rencontre',
        10 => 'recevoir_doc',
        11 => 'besoins',
        12 => 'participe',
        13 => 'creneau',
    ];
    $data_rows = [];
    global $wpdb, $bp;
    $clients = $wpdb->get_results($wpdb->prepare("select * FROM $table_name"));

    foreach ($clients as $client) {

        $row = [
            $client->id,
            $client->nom,
            $client->prenom,
            $client->email,
            $client->mobile,
            $client->entreprise,
            $client->secteur_activite,
            $client->autre,
            $client->rencontre,
            $client->recevoir_doc,
            $client->besoins,
            $client->participe,
            $client->creneau];
        $data_rows[] = $row;
    }
    $fh = @fopen('php://output', 'w');
    fprintf($fh, chr(0xEF) . chr(0xBB) . chr(0xBF));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Description: File Transfer');
    header('Content-type: text/csv');
    header("Content-Disposition: attachment; filename={$filename}");
    header('Expires: 0');
    header('Pragma: public');
    fputcsv($fh, $header_row);
    foreach ($data_rows as $data_row) {
        fputcsv($fh, $data_row);
    }
    fclose($fh);
    die();
}
