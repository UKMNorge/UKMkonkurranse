<?php
	
require_once('UKM/Konkurranse/geocache.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$sporsmal = GeocacheColl::create( $_POST['new_geocache'], $_POST['new_geocache_type'] );
}

if( isset($_GET['delete'] ) && $_GET['delete'] == 'geocache' && isset( $_GET['delete_id'] ) && is_numeric( $_GET['delete_id'] ) ) {
	$geocache = GeocacheColl::getById( $_GET['delete_id'] );
	GeocacheColl::delete( $geocache );
}

UKMkonkurranse::addViewData('geocacher', GeocacheColl::getAllByName() );