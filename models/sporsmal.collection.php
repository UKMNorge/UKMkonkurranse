<?php


require_once('UKM/_orm.collection.php');
require_once(UKMKONKURRANSE_PATH.'models/sporsmal.class.php');
	
class SporsmalColl extends Coll {
	const TABLE_NAME = Sporsmal::TABLE_NAME;
	public static $models = null;
}