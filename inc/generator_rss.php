<?php

	include('db.php');
	include('func.php');


	$vdm_xml = file_get_contents("http://feeds.betacie.com/viedemerde"); //recup du flux xml
	$vdm_object = simplexml_load_string($vdm_xml,'SimpleXMLElement',LIBXML_NOCDATA);//creation de l'objet
	$vdm_array = json_decode(json_encode($vdm_object), true);//decoder encoder l'objet pour créer un tableaux


	$entrys = $vdm_array['entry'];


	foreach($entrys as $key => $entry) {
		$name = $entry['author']['name'];
		$content = $entry['content'];
		$creation_date = $entry['published'];
		$creation_date = date('Y-m-d H:i',strtotime($creation_date));

		$sql = 'INSERT INTO article (name,content,creation_date) VALUES (:name,:content,:creation_date)';
		$query = $db->prepare($sql);
		$query->bindValue('name',$name,PDO::PARAM_STR);
		$query->bindValue('content',$content,PDO::PARAM_STR);
		$query->bindValue('creation_date',$creation_date,PDO::PARAM_STR);
		$query->execute();

}



?>
