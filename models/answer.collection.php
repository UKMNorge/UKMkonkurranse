<?php


require_once('UKM/_orm.collection.php');
require_once(UKMKONKURRANSE_PATH.'models/answer.class.php');
	
class AnswerColl extends Coll {
	const TABLE_NAME = Answer::TABLE_NAME;
	public static $models = null;

	public static function create( $name, $sporsmalId ) {
		$object = self::_create( [
			'name' => $name,
			'sporsmal_id' => $sporsmalId,
			]
		);
		return $object;
	}

}