<?php
	
require_once(UKMKONKURRANSE_PATH. 'models/sporsmal.collection.php');

UKMkonkurranse::addViewData('sporsmal', SporsmalColl::getAllByName() );