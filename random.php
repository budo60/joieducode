<?php

	include_once('partials/header.php');
	$sql = 'SELECT * FROM article ORDER BY RAND() LIMIT 1';
	$query = $db->query($sql);
	$article = $query->fetch();
 ?>

	<h1>Une Joie du code au hasard</h1>

	<hr>

	<?php

		include('partials/article_common.php');
		include_once('partials/footer.php');
	?>