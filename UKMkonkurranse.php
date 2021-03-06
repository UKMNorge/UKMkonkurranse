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

if( get_option('site_type') == 'land' ) {
    #UKMkonkurranse::hook();
}



add_action( 'wp_ajax_nopriv_UKMkonkurranse', ['UKMkonkurranse','ajax'] );
add_action( 'wp_ajax_UKMkonkurranse', ['UKMkonkurranse','ajax'] );


function UKMkonkurranseTemplateFilter( $template ) {
	global $post;
	
	if( false != get_post_meta( $post->ID, 'UKMkonkurranse', true ) ) {
		// Check if a custom template exists in the theme folder, if not, load the plugin template file
		$template = UKMKONKURRANSE_PATH . 'template.php';
	}

	return $template;
}

class UKMkonkurranse extends UKMNorge\Wordpress\Modul
{
	public static function ajax() {
		$response = [
			'action' => $_POST['ajaxaction'],
			'trigger' => $_POST['trigger'],
			'success' => false,
		];
		require_once( UKMKONKURRANSE_PATH . 'ajax.php');
		echo json_encode( $response );
		wp_die();
	}
	/**
	 * Initier Videresending-objektet
	 *
	**/
	public static function init( $pl_id=null ) {
		self::setAction('home');
		parent::init(null);
    }
    
    public static function hook() {
        add_action('admin_menu', [static::class,'meny']);
    }
	
	/**
	 * Generer admin-GUI
	 *
	 * @return void, echo GUI.
	**/
	public static function admin() {
		self::init();
		## ACTION CONTROLLER
		require_once('controller/'. self::getAction() .'.controller.php');
		
		## RENDER
		echo TWIG( 'Admin/'. strtolower(self::getAction()) .'.html.twig', self::getViewData() , dirname(__FILE__), true);
		echo TWIGjs( dirname(__FILE__) );
		return;
	}

	/**
	 * Generer admin-GUI
	 *
	 * @return void, echo GUI.
	**/
	public static function adminGeocache() {
		self::init();
		## ACTION CONTROLLER
		require_once('controller/geocache/'. self::getAction() .'.controller.php');
		
		## RENDER
		echo TWIG( 'Admin/Geocache/'. strtolower(self::getAction()) .'.html.twig', self::getViewData() , dirname(__FILE__), true);
		echo TWIGjs( dirname(__FILE__) );
		return;
	}


	/**
	 * Registrer menyer
	 *
	**/
	public static function meny() {
		$page = add_menu_page(
			'Konkurranse', 
			'Konkurranse',
			'administrator', 
			'konkurranse',
			['UKMkonkurranse','admin'],
			'//ico.ukm.no/prize-menu.png',
			20
		);
		add_action(
			'admin_print_styles-' . $page,
			['UKMkonkurranse', 'scripts_and_styles']
		);
        
        
        
		// Legg geocache som en submeny.
		$page = add_submenu_page(
			'konkurranse',
			'Geocache',
			'Geocache',
			'administrator',
			'geocache',
			['UKMkonkurranse', 'adminGeocache']
		);
        add_action(
            'admin_print_styles-'. $page,
			['UKMkonkurranse', 'scripts_and_styles']	# Script-funksjon
		);

	}
	
	public static function scripts_and_styles() {
		wp_enqueue_script('WPbootstrap3_js');
		wp_enqueue_style('WPbootstrap3_css');
		wp_enqueue_script('TwigJS');
	}

}
