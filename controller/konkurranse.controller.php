<?php
	
require_once(UKMKONKURRANSE_PATH . 'models/sporsmal.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$sporsmal = new sporsmal( $_GET['id'] );
	$sporsmal->getAlternatives()->create( $_POST['new_alternative'] );
}

if( isset($_GET['delete'] ) && $_GET['delete'] == 'alternative' && isset( $_GET['delete_id'] ) && is_numeric( $_GET['delete_id'] ) ) {
	$sporsmal = new sporsmal( $_GET['id'] );
	$sporsmal->getAlternatives()->delete( $_GET['delete_id'] );
}

if( is_numeric( $_GET['id'] ) ) {
	$sporsmal = SporsmalColl::getById( $_GET['id'] );
	
	UKMkonkurranse::addViewData('sporsmal', $sporsmal );
	
	if( $sporsmal->getType() == 'dynamisk') {
		switch( $sporsmal->getAnswerType() ) {
			case 'fylke':
				require_once('UKM/fylker.class.php');
				UKMkonkurranse::addViewData('fylker', fylker::getAll() );
			break;
		}
	}
}