<?php

	$id = (!empty($_GET['id'])) ? intval($_GET['id']) : 0;

	include_once('partials/header.php');

	$sql = 'SELECT * FROM article WHERE id = :id';
	$query = $db->prepare($sql);
	$query->bindValue('id',$id,PDO::PARAM_INT);
	$query->execute();

	$article = $query->fetch();
 ?>

	<h1>Une Joie du code </h1>

	<hr>

	<?php

		include('partials/article_common.php');
		include_once('partials/footer.php');
	?>