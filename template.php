<?php

use UKMNorge\DesignBundle\Utils\Sitemap;
use UKMNorge\DesignBundle\Utils\SEO;

require_once( rtrim( get_template_directory(), '/') .'/header.php');

global $post;
$konkurranse = get_post_meta( $post->ID, 'UKMkonkurranse', true );

if( file_exists( 'controller/'. $konkurranse .'.controller.php') ) {
	require_once('controller/'. $konkurranse .'.controller.php');
}

if( is_array( $viewData ) ) {
	$RENDERDATA = array_merge( $WP_TWIG_DATA, $viewData );
} else {
	$RENDERDATA = $WP_TWIG_DATA;
}

echo WP_TWIG::render( 'Konkurranse/'. $konkurranse, $RENDERDATA );

wp_footer();
?>