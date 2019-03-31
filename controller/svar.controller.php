<?php
	
require_once('UKM/Konkurranse/answer.collection.php');

$sporsmal = new sporsmal( $_GET['konkurranse'] );


UKMkonkurranse::addViewData('svar', AnswerColl::getByQuestion( $_GET['konkurranse'] ) );
UKMkonkurranse::addViewData('sporsmal', SporsmalColl::getById( $_GET['konkurranse'] ) );