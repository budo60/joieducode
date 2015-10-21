<?php

function debug($tableau) {
	return '<pre>'.print_r($tableau, true).'</pre>';
}

function cutString($text, $max_length, $end = '...') {
	$sep ='[@]';
	//Si $max_lenght est positif et que la chaine $text est plus longue que $max_length
	if($max_length > 0 && strlen($text) > $max_length) {
		//On intercalle la chaine $sep tous les x caracteres
		$text = wordwrap($text,$max_length,$sep,true);
		//on decoupe la chiane en plusierus bout
		$text = explode($sep,$text);
		//on retourne le premier mot
		return $text[0].$end;
		/*return substr($text,0, $max_length).$end;*/
	}
	return $text;

}

function getContent($description, $max_length = 0,$id = 0) {
	if($max_length <= 0) {
		return nl2br($description);
	}
	return cutString($description, $max_length, ' <a href="article.php?id='.$id.'"> [...]</a>');
}

function getDateFormat($date) {
	$date = strtotime($date);
	$date = date('d/m/Y H:i',$date);
	return $date;
}

function getName($name){
	return ucfirst($name);
}

?>