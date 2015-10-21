<?php

	include_once('partials/header.php');

	$search = (!empty($_GET['search'])) ? $_GET['search'] : '';
	$count_total = '0';
	$results = array();

	if(!empty($search)) {

		$sql = 'SELECT * FROM article WHERE name LIKE :search OR content LIKE :search';
		$query = $db->prepare($sql);
		$query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll();
		$count_total = $query->rowCount();
	}

?>
	<h1><?= $count_total ?> résultats pour la recherche "<?= $search ?>"</h1>
	<hr>
	<?php foreach($results as $result) { ?>
	<div class="post">
	    <p><?= getDateFormat($result['creation_date']) ?> par <a href="#"><?= getName($result['name']) ?></a></p>

	    <blockquote>
	      <p><?= getContent($result['content'],100,$result['id']) ?></p>
	    </blockquote>
	</div>
	<?php }
	 ?>

<?php include_once('partials/footer.php'); ?>