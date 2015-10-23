<?php

// UTILS
function debug($array) {
	return '<pre>'.print_r($array, true).'</pre>';
}

/*
	Coupe une chaine à la longueur $max_length en préservant les mots
*/
function cutString($text, $max_length, $end = '...') {
	// On défini une chaine qu'on va intercaller tous les X caractères en préservant les mots
	$sep = '[@]';

	// Si $max_length est positif et que la chaine $text est plus longue que $max_length
	if ($max_length > 0 && strlen($text) > $max_length) {
		// On intercalle la chaine $sep tous les X caractères
		$text = wordwrap($text, $max_length, $sep, true);
		// On découpe la chaine en plusieurs bouts dans un tableau
		$text = explode($sep, $text);
		// On retourne la première valeur du tableau et on concatène avec la chaine $end
		return $text[0].$end;
	}
	// On retourne la chaine telle qu'on l'a reçu
	return $text;
}

function getFormatDate($date, $format = 'd-m-Y') {
	return date($format,strtotime($date));
}

// AUTHENT

function userLogin($user) {
	if (empty($user)) {
		return false;
	}
	$_SESSION['user_id'] = $user['id'];
	$_SESSION['firstname'] = $user['firstname'];
	$_SESSION['lastname'] = $user['lastname'];
	return true;
}

function userIsLogged() {
	return !empty($_SESSION['user_id']);
}

// Article JDC


function displayList($list,$title,$class,$url = 'movie.php') {

	$html = '<div class="panel panel-'.$class.'">';
	$html .= '<div class="panel-heading">'.$title.'</div>';
	$html .= '<div class="list-group">';
	foreach($list as $key => $item) {
		$html .= '<a href="'.$url.'?id='.$item['id'].'" class="list-group-item">'.($key + 1).' - '.getTitle($item['title']).'</a>';
	}
	$html .= '</div>';
	$html .= '</div>';
	return $html;

}

//USER

function user_getFullName($user) {
	return (ucfirst($user['firstname']).' '.ucfirst($user['lastname']));
}

function user_getGenderLabel($gender) {
	global $genders, $gender_labels;
	if(isset($genders[$gender])) {
		$gender = $genders[$gender];
	}
	if(isset($gender_labels[$gender])) {
		return $gender_labels[$gender];
	}
	return 'N/A';
}