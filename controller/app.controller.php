<?php
	
require_once('UKM/Konkurranse/config.class.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	Config::set( 'app_active', $_POST['app_active'] );
}

if( isset( $_GET['reset'] ) ) {
	Config::set('app_active', 0);
	UKMkonkurranse::addViewData('reset', true);
}



require_once('UKM/Konkurranse/sporsmal.collection.php');
$konkurranse = new sporsmal( Config::get('app_active') );
UKMkonkurranse::addViewData('konkurranse', $konkurranse );