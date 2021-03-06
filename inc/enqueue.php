<?php
/**
 * Include default scripts and css in frontend
 *
 * Note : When you are working in live uncomment the cdn file and comment the local file
 **/
if ( ! function_exists( 'enqueue_style_script' ) ) {
    add_action('wp_enqueue_scripts','enqueue_style_script');
    function enqueue_style_script() {
        /**
         * Third Party
         */
        /* Nicescroll */
        // wp_register_script( 'nicescroll', '//cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js', array('jquery'), NULL, true );
        wp_register_script( 'nicescroll', THEME_URL .'/vendors/nicescroll-3.7.6/jquery.nicescroll.min.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'nicescroll' );

        /* Fontawesome */
        wp_enqueue_style( 'fontawesome', '//use.fontawesome.com/releases/v5.0.13/css/all.css' );

        /* Bootstrap */
        // wp_register_script( 'popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), NULL, true );
        wp_register_script( 'popper', THEME_URL .'/vendors/bootstrap-4.0.0/popper.min.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'popper' );

        // wp_register_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), NULL, true );
        wp_register_script( 'bootstrap', THEME_URL .'/vendors/bootstrap-4.0.0/js/bootstrap.min.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'bootstrap' );

        /* Object Fit - To make image object fit compatible on IE */
        wp_register_script( 'object-fit', THEME_URL .'/vendors/object-fit/ofi.min.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'object-fit' );

        /**
         * Developer's assets
         */
        /* Styles */
        wp_enqueue_style('general', THEME_URL .'/assets/style/css/general.css');
        wp_enqueue_style('frontend-custom-tinymce', THEME_URL .'/assets/style/css/tinymce.css');

        /* JasvaScript */        
        /**
         * Guide on how to name and include your custom script
         *
         * For team project : custom-*.js
         * For individual project : custom.js
         */
        // wp_register_script( 'file-name', THEME_URL . '/assets/js/file-name.js', array( 'jquery' ), NULL, true );
        // wp_enqueue_script( 'file-name' );
        
        wp_register_script( 'common-js', THEME_URL  .'/assets/js/common.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'common-js' );

        /* AJAX Script */
        // wp_register_script( 'function-name', THEME_URL . '/inc/ajax/function-name/function-name.js', array( 'jquery' ), NULL, true );
        // wp_enqueue_script( 'function-name' );


        /**
         * Browser Compatibility
         */
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        if( preg_match( '/trident/i', $u_agent ) ) {
            /**
             * Enqueue your style/script only @ IE
             */
            wp_enqueue_style('explorer', THEME_URL .'/assets/style/css/ie.css');
        } 
        elseif( preg_match( '/firefox/i', $u_agent ) ) {
            /**
             * Enqueue your style/script only @ Mozilla Firefox
             */
            wp_enqueue_style('firefox', THEME_URL .'/assets/style/css/firefox.css');
        } 
        elseif( preg_match( '/mac/i', $u_agent ) ) {
            /**
             * Enqueue your style/script only @ Safari
             */
            wp_enqueue_style('safari', THEME_URL .'/assets/style/css/safari.css');
        } 
        elseif( preg_match( '/chrome/i', $u_agent ) ) {
            /**
             * Enqueue your style/script only @ Google Chrome
             */
            wp_enqueue_style('chrome', THEME_URL .'/assets/style/css/chrome.css');
        } 
        elseif( preg_match( '/Opera/i',$u_agent ) || preg_match( '/OPR/i',$u_agent ) ) {
            /**
             * Enqueue your style/script only @ Opera
             */
            wp_enqueue_style('opera', THEME_URL .'/assets/style/css/opera.css');
        }
    }
}

/**
 * Include default scripts and css in backend
 **/
if ( ! function_exists( 'enqueue_admin_style_script' ) ) {
    add_action( 'admin_enqueue_scripts', 'enqueue_admin_style_script' );
    function enqueue_admin_style_script() {
        /* 
         * Register/Hook Scripts for backend
         */
        wp_register_script( 'backend', THEME_URL .'/assets/js/backend.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'backend' );

        /* 
         * Register/Hook Style for backend
         */
        wp_enqueue_style('backend-custom-tinymce', THEME_URL .'/assets/style/css/tinymce.css');
    }
}

add_filter('style_loader_tag', 'myplugin_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'myplugin_remove_type_attr', 10, 2);
function myplugin_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}