<?php
	
require_once('UKM/Konkurranse/sporsmal.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	
	if( isset($_POST['new_alternative'] ) ) { 
		$sporsmal = new sporsmal( $_GET['id'] );
		$sporsmal->getAlternatives()->create( $_POST['new_alternative'] );
	}
	
	if( isset( $_POST['name'] ) ) {
		$sporsmal = new sporsmal( $_GET['id'] );
		$sporsmal->setName( $_POST['name'] );
		$sporsmal->setType( $_POST['type'] );
		$sporsmal->setAnswerType( $_POST['svar_type'] );
		$sporsmal->update();
	}
}

if( isset($_GET['delete'] ) && $_GET['delete'] == 'alternative' && isset( $_GET['delete_id'] ) && is_numeric( $_GET['delete_id'] ) ) {
	$sporsmal = new sporsmal( $_GET['id'] );
	$sporsmal->getAlternatives()->delete( $_GET['delete_id'] );
}

if( is_numeric( $_GET['id'] ) ) {
	$sporsmal = SporsmalColl::getById( $_GET['id'] );
	
	UKMkonkurranse::addViewData('sporsmal', $sporsmal );
}