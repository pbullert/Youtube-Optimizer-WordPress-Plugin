<?php
/*
Plugin Name: Youtube Optimizer
Description: This plugin optimizes embedded Youtube Videos on your website for faster page loads. Youtube's embedding method isnt very efficient, by default it downloads the video player on every occurance of Youtube video; which in return slows down your website. The plugin shows a video thumbnail to your viewer and loads the Youtube video only when the user clicks on the play icon.
Version: 1.0
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}
 
/* Queue Scripts */
add_action( 'wp_enqueue_scripts', 'include_script_that_depends_on_jquery' );

function include_script_that_depends_on_jquery() {
    wp_enqueue_script( 'script', plugins_url() . '/youtube-optimizer/js/yt-script.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_style( 'style', plugins_url() . '/youtube-optimizer/css/yt-style.css' );
}

/* Add to Menu */
add_action('admin_menu', 'ytoptimizer_plugin_setup_menu');
function ytoptimizer_plugin_setup_menu(){
        add_menu_page( 'Youtube Optimizer Settings', 'Yt Optimizer', 'manage_options', 'youtube-optimizer', 'yt_admin_page' );
}

/* Register Options */
add_action( 'admin_init', function() {
    register_setting( 'yt-optimizer-plugin-settings', 'map_name' );
});

add_action( 'admin_init', function() {
    register_setting( 'yt-optimizer-plugin-settings', 'yt_width' );
    register_setting( 'yt-optimizer-plugin-settings', 'yt_height' );
});

/* Admin Settings Page */
function yt_admin_page(){
    echo '<div class="wrap">';
    echo '<h1>Youtube Optimizer Settings</h1>';
?>
	
	<form action="options.php" method="post">
       
       <?php
       settings_fields( 'yt-optimizer-plugin-settings' );
       do_settings_sections( 'yt-optimizer-plugin-settings' );

       if(!get_option('yt_width')){$width = '640px';} else{ $width = esc_attr( get_option('yt_width') );}
       if(!get_option('yt_height')){$height = '380px';} else{ $height = esc_attr( get_option('yt_height') );}

       ?>

       <table class="form-table">
        <tr valign="top">
        <th scope="row">Width:</th>
        <td><input type="text" name="yt_width" value="<?php echo $width; ?>" size="10" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Height:</th>
        <td><input type="text" name="yt_height" value="<?php echo $height; ?>" size="10" /></td>
        </tr>
      </table>
    
      <?php submit_button(); ?>
    </form>

<?php
  echo'</div>';
}

function inline_css() {
	if(!get_option('yt_width')){$width = '640px';} else{ $width = esc_attr( get_option('yt_width') );}
    if(!get_option('yt_height')){$height = '380px';} else{ $height = esc_attr( get_option('yt_height') );}
 	echo '<style>.ytVideo{width: ' . $width . '; height: ' . $height . ';}</style>';
}
add_action( 'wp_head', 'inline_css', 0 );




