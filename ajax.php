<?php

use UKMNorge\Database\SQL\Insert;

require_once('UKM/Autoloader.php');
require_once('UKM/Konkurranse/sporsmal.collection.php');
require_once('UKM/Konkurranse/answer.collection.php');

$response['action'] = $_POST['konkurranse'];
$response['sporsmal'] = $_POST['sporsmal'];

switch( $_POST['konkurranse'] ) {
	case 'svar':
		$SQLins = new Insert('konkurranse_svar');
		$SQLins->add('mobil', $_POST['mobil'] );
		
		// STANDARD-SPØRSMÅL (med alternativer)
		if( is_numeric( $_POST['sporsmal'] ) ) {
			$sporsmal = SporsmalColl::getById( $_POST['sporsmal'] );
			$SQLins->add('sporsmal_id', $_POST['sporsmal']);
			if( $sporsmal->getType() == 'standard' ) {
				$SQLins->add('alternativ_id', $_POST['svar']);
			} else {
				$SQLins->add('svar', $_POST['svar']);
			}
			$res = $SQLins->run();
		}
		// DYNAMISKE SPØRSMÅL (med custom-code)
		else {
			switch( $_POST['sporsmal'] ) {
				case 'korslaget-fylke':
					$SQLins->add('sporsmal_id', 1);
					break;
				case 'onskereprise-12791': 
					$SQLins->add('sporsmal_id', 2);
					break;
				case 'onskereprise-12792': 
					$SQLins->add('sporsmal_id', 7);
					break;
				case 'onskereprise-12793': 
					$SQLins->add('sporsmal_id', 8);
					break;
				case 'onskereprise-12794': 
					$SQLins->add('sporsmal_id', 9);
					break;
				case 'onskereprise-12795': 
					$SQLins->add('sporsmal_id', 10);
					break;
				case 'onskereprise-12796': 
					$SQLins->add('sporsmal_id', 11);
					break;
			}
			$SQLins->add('svar', $_POST['svar']);
		}
		
		$res = $SQLins->run();
		break;
	case 'har':
	case 'get':
		$sporsmal = SporsmalColl::getById( $_POST['sporsmal'] );
		$answer = AnswerColl::getByQuestionAndUser( $sporsmal, $_POST['mobil'] );
		
		if( $answer ) {
			$response['harSvart'] = true;
			$response['svar'] = $answer->getAnswer();
		} else {
			$response['harSvart'] = false;
		}
}

$response['success'] = true;