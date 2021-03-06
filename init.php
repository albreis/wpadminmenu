<?php global $plugin_name;

/**
 * URL do plugin
 */
$plugin_url = plugin_dir_url( __FILE__ );

/**
 * Nome do componente
 */
$component = basename(dirname(__FILE__));

/**
 * Título do menu
 */
$component_name = 'Upsell';

/**
 * Inicializa o menu do admin
 */
add_action('admin_menu', function() use ($plugin_name, $component_name, $component){

    /**
     * Menu de principal
     */
    add_menu_page( $component_name, $component_name, 'manage_options', "{$plugin_name}", function(){ 
        include __DIR__ . '/index.php';
    }, get_site_icon_url(), -1);

    /**
     * Normaliza o nome do menu para não se repetir com o principal
     */
    add_submenu_page( $plugin_name, 'Dashboard', 'Dashboard', 'manage_options', "{$plugin_name}", function(){ 
        include __DIR__ . '/index.php';
    }, 0);
});

/**
 * Adiciona scripts globais no admin
 */
add_action( 'admin_enqueue_scripts', function() use ($plugin_name, $plugin_url){
    pluginDefaultScripts($plugin_url);
    wp_enqueue_style( $plugin_name . '-admin-style', $plugin_url . 'admin.css', array(), time() );
    wp_enqueue_script( $plugin_name . '-admin-script', $plugin_url . 'admin.js', array('jquery'), time() );
});

/**
 * Adiciona scripts globais no front
 */
add_action( 'wp_enqueue_scripts', function() use ($plugin_name, $plugin_url){
    pluginDefaultScripts($plugin_url);
    wp_enqueue_style( $plugin_name . '-front-style', $plugin_url . 'front.css', array(), time() );
    wp_enqueue_script( $plugin_name . '-front-script', $plugin_url . 'front.js', array('jquery'), time() );
});

function pluginDefaultScripts($plugin_url) {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), time() );
    wp_enqueue_script( 'vue', $plugin_url . 'vue.min.js', array('jquery'), time() );
    wp_enqueue_script( 'axios', $plugin_url . 'axios.min.js', array('jquery'), time() );
    wp_enqueue_script( 'vuelidate', $plugin_url . 'vuelidate.min.js', array('jquery'), time() );
    wp_enqueue_script( 'validators', $plugin_url . 'validators.min.js', array('jquery'), time() );
    wp_enqueue_script( 'jquery-masked-plugin', $plugin_url . 'jquery.mask.min.js', array('jquery'), time() );
}