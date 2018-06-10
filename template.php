<?php

use UKMNorge\DesignBundle\Utils\Sitemap;
use UKMNorge\DesignBundle\Utils\SEO;

require_once( rtrim( get_template_directory(), '/') .'/header.php');

global $post;
$konkurranse = get_post_meta( $post->ID, 'UKMkonkurranse', true );

if( isset( $_GET['sporsmal'] ) ) {
	require_once(UKMKONKURRANSE_PATH. 'models/sporsmal.collection.php');
	$sporsmal = SporsmalColl::getById( $_GET['sporsmal'] );
	$konkurranse = $sporsmal->getType();
	$WP_TWIG_DATA['sporsmal'] = $sporsmal;
	
	if( isset( $_COOKIE['UKMMobil'] ) ) {
		require_once(UKMKONKURRANSE_PATH. 'models/answer.collection.php');
		$WP_TWIG_DATA['UKMMobil'] = $_COOKIE['UKMMobil'];	
		$WP_TWIG_DATA['answer'] = AnswerColl::getByQuestionAndUser( $sporsmal->getId(), $_COOKIE['UKMMobil'] );
	}
} else {
	$konkurranse = 'registrert';
}

if( file_exists( 'konkurranse/'. $konkurranse .'.controller.php') ) {
	require_once('konkurranse/'. $konkurranse .'.controller.php');
}

if( is_array( $viewData ) ) {
	$RENDERDATA = array_merge( $WP_TWIG_DATA, $viewData );
} else {
	$RENDERDATA = $WP_TWIG_DATA;
}

echo WP_TWIG::render( 'Konkurranse/'. $konkurranse, $RENDERDATA );

wp_footer();
?>