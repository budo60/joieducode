<?php
session_name('jdc_sess');
session_start();

$current_page = basename($_SERVER['PHP_SELF']);

$pages = array(
	'index.php' => 'Home',
	'random.php' => 'JDC aléatoire',
	'send.php' => 'Envoyer votre JDC',
);

define('USER_GENDER_MALE', 1);
define('USER_GENDER_FEMALE', 2);

$genders = array(
	USER_GENDER_MALE => 'male',
	USER_GENDER_FEMALE => 'female'
);

$gender_labels = array(
	'male' => 'Homme',
	'female' => 'Femme'
	);