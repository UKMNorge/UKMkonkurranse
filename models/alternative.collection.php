<?php


require_once('UKM/_orm.instanceCollection.php');
require_once(UKMKONKURRANSE_PATH.'models/alternative.class.php');
require_once(UKMKONKURRANSE_PATH.'models/alternative_fylke.class.php');

class AlternativeColl extends InstanceColl {
	const TABLE_NAME = Alternative::TABLE_NAME;
	const PARENT_FIELD = Alternative::PARENT_FIELD;
	
	public $models = null;
	public $sporsmalId = null;
	public $type = null;

	public function __construct( $id, $type ) {
		parent::__construct( $id );
		$this->setType( $type );
	}
	
	public function setType( $type ) {
		$this->type = $type;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	
	public function getAllByName() {
		if( $this->getType() == 'fylke' ) {
			require_once('UKM/fylker.class.php');
			
			foreach( fylker::getAll() as $fylke ) {
				$this->models[] = new AlternativeFylke( $this->getParentId(), $fylke);
			}
			return $this->models;
		}
		
		
		return parent::getAllByName();
	}
	
	public function create( $name ) {
		$object = $this->_create( [
			'name' => $name,
			]
		);
		return $object;
	}

	public function delete( $id ) {
		$this->_delete( [
			'id' => $id
			]
		);
	}
	
	public static function getTableName() {
		return self::TABLE_NAME;
	}
	public static function getParentField() {
		return self::PARENT_FIELD;
	}
}