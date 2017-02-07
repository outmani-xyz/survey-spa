<?php

/*
  Plugin Name: survey
  Description: this app is simple survey
  Version: 1.0
  Author: outmani abdelhamid http://outmani.xyz
  Author URI: http://outmani.xyz
 */

//other code relating to admin stuff
//Template fallback
add_action("template_redirect", 'my_theme_redirect');

function my_theme_redirect() {
    global $wp;
    $plugindir = dirname(__FILE__);

    //A Specific Custom Post Type
    if ($wp->query_vars["post_type"] == 'gift-sirha') {
        $templatefilename = 'land.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = $plugindir . '/land/' . $templatefilename;
        }
        do_theme_redirect($return_template);

        //A Custom Taxonomy Page
    }
    //A Simple Page
    elseif ($wp->query_vars["pagename"] == 'gift-sirha') {
        $templatefilename = 'land.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = $plugindir . '/land/' . $templatefilename;
        }
        do_theme_redirect($return_template);
    }
}

function do_theme_redirect($url) {
    global $post, $wp_query;
    if (have_posts()) {
        include($url);
        die();
    } else {
        $wp_query->is_404 = true;
    }
}

// function to create the DB  Defaults					
function outm_options_install() {

    global $wpdb;
    $table_name = $wpdb->prefix . "outm_survey";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        `id` INT NOT NULL AUTO_INCREMENT , 
        `nom` VARCHAR(50)  NULL , 
        `prenom` VARCHAR(50)  NULL ,
        `email` VARCHAR(100)  NULL ,
        `mobile` VARCHAR(20)  NULL , 
        `entreprise` VARCHAR(100)  NULL ,
        `secteur_activite` VARCHAR(500)  NULL ,
        `autre` VARCHAR(100)  NULL ,
        `rencontre` ENUM('oui','no')  NULL , 
        `recevoir_doc` ENUM('oui','no')  NULL ,
        `besoins` text  NULL ,
        `participe` ENUM('oui','no')  NULL ,
        `creneau` DATE  NULL ,
        PRIMARY KEY (`id`)
          ) $charset_collate; ";


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'outm_options_install');

//menu items
add_action('admin_menu', 'outm_survey_menu');

function outm_survey_menu() {

    //this is the main item for the menu
    add_menu_page('survey', //page title
            'Survey', //menu title
            'manage_options', //capabilities
            'outm_survey_list', //menu slug
            'outm_survey_list' //function
    );

    //this is a submenu
    add_submenu_page('outm_survey_list', //parent slug
            'Add New Client', //page title
            'Add New', //menu title
            'manage_options', //capability
            'outm_survey_create', //menu slug
            'outm_survey_create'); //function
    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
            'Update Client', //page title
            'Update', //menu title
            'manage_options', //capability
            'outm_survey_update', //menu slug
            'outm_survey_update'); //function  
    add_submenu_page(null, //parent slug
            'Export Client', //page title
            'Export', //menu title
            'manage_options', //capability
            'outm_survey_export', //menu slug
            'outm_survey_export'); //function  

}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'survey-list.php');
require_once(ROOTDIR . 'survey-create.php');
require_once(ROOTDIR . 'survey-update.php');
require_once(ROOTDIR . 'survey-export.php');
