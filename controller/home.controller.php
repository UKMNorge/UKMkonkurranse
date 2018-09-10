<?php
	
require_once(UKMKONKURRANSE_PATH. 'models/sporsmal.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$sporsmal = SporsmalColl::create( $_POST['new_question'], $_POST['new_type'] );
}

if( isset($_GET['delete'] ) && $_GET['delete'] == 'konkurranse' && isset( $_GET['delete_id'] ) && is_numeric( $_GET['delete_id'] ) ) {
	$sporsmal = SporsmalColl::getById( $_GET['delete_id'] );
	SporsmalColl::delete( $sporsmal );
}


UKMkonkurranse::addViewData('sporsmal', SporsmalColl::getAllByName() );