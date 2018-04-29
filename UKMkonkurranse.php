<?php  
/* 
Plugin Name: UKM-konkurranser
Plugin URI: http://www.ukm.no
Description: Kjappe små konkurranser basert på UKMmobil() (lagret cookie)
Author: Marius Mandal 
Version: 0.1
Author URI: http://mariusmandal.no
*/

define('UKMKONKURRANSE_PATH', rtrim( plugin_dir_path( __FILE__ ), '/' ).'/' );
define('UKMKONKURRANSE_URL', rtrim( plugin_dir_url( __FILE__), '/').'/');


add_filter( 'template_include', 'UKMkonkurranseTemplateFilter' );

function UKMkonkurranseTemplateFilter( $template ) {
	global $post;
	
	if( false != get_post_meta( $post->ID, 'UKMkonkurranse', true ) ) {
		// Check if a custom template exists in the theme folder, if not, load the plugin template file
		$template = UKMKONKURRANSE_PATH . 'template.php';
	}

	return $template;
}
