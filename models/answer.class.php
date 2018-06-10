<?php


require_once('UKM/_orm.class.php');
	
class Answer extends ORM {
	const TABLE_NAME = 'konkurranse_svar';
	
	var $sporsmalId = null;
	var $alternativeId = null;
	var $answer = null;
	var $mobile = null;
	
	public function populate( $row ) {
		$this->setSporsmalId( $row['sporsmal_id'] );
		$this->setName( $row['name'] );
	}
	
	public function setSporsmalId( $id ) {
		$this->sporsmalId = $id;
		return $this;
	}
	public function getSporsmalID() {
		return $this->sporsmalId;
	}
	public function setAlternativeId( $id ) {
		$this->alternativeId = $id;
		return $this;
	}
	public function getAlternativeId() {
		return $this->alternativeId;
	}

	public function getAnswer() {
		return $this->answer;
	}
	
	public function __toString() {
		return $this->getAnswer();
	}
}