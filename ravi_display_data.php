<?php 
/*
    Plugin Name: display data
    Plugin URI: http://www.google.com
    Description: This plugin will show the list of User ID,First Name,Last Name,Email ID,Billing Phone,Total order count
    order number
    Author: Ravi Mourya
    Author URI: http://www.google.com
    Version: 1.0.1
*/

// hook call kiya jab plugin activate hoga to uska action yaha se set hoga
register_activation_hook(__FILE__,'displayDataActivate');     

// hook call kiya jab plugin deactivate hoga to uska action yaha se set hoga
register_deactivation_hook(__FILE__,'displayDataDeactivate'); 

function displayDataActivate(){
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix.'form_data';
    $sql = "CREATE TABLE wp_form_data ( `id` int(11) NOT NULL, `name` varchar(60) NOT NULL ) ";
    // displayThis($sql);
    $wpdb->query($sql);
}


function displayDataDeactivate(){
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix.'form_data';
    $sql = "DROP TABLE  $table";
    $wpdb->query($sql);
}

/* ====================Admin ke sidebar me new menu add krne ka syntax============================*/

// syntax : add_action('kaha pe add krna hai','functionName()');
            add_action('admin_menu','form_data_menu');  // ye bhi ek hook hai

function form_data_menu(){
// Creating sidebar menu with name : "Ravi task here"
// Syntax :add_menu_page('To be display', 'To be display',index,Location,'functionName()');  
           add_menu_page('Ravi task here', 'Ravi task here',8,__FILE__,'form_data_list');
}

// User jab click krega tab ye function run hoga
 function form_data_list(){
   include ('display_data.php');
 }

// add_action( 'admin_menu', 'my_admin_menu' );

// function my_admin_menu() {
// 	add_menu_page( 'My Top Level Menu Example', 'Top Level Menu', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-tickets', 6  );
// }

/* Creating ShortCode */
// Syntax : add_sortcode('shortCodeName', "What to be display")
            add_shortcode('shrtcode_by_ravi','form_data_list');
            // add_shortcode('shrtcodeByRavi','form_data_list');



function customFunction(){
    return "foo bar";
}
add_shortcode('custome_sc','customFunction');

function customFunction1($att){
    $a = shortcode_atts(array(
        'users' => 'username',
        'products'=>'products'
        ), $atts);
    return "users = {$a['users']}";
}

add_shortcode('custom_scone','customFunction1');


function bartag_func( $atts ) {
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );
 
    return "foo = {$a['foo']}";
}
add_shortcode( 'bartag', 'bartag_func' );


?>
















