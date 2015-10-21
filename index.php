<?php
	include('partials/header.php');

	$sql = 'SELECT * FROM article ORDER BY id DESC LIMIT 10';
	$query = $db->query($sql);
	$articles = $query->fetchAll();
?>

		<h1>Les dernières Joies du code</h1>

		<hr>
		<?php foreach($articles as $article) { ?>
		<div class="post">
		    <p><?= getDateFormat($article['creation_date']) ?> par <a href="#"><?= getName($article['name']) ?></a></p>

		    <blockquote>
		      <p><?= getContent($article['content'],100,$article['id']) ?></p>
		    </blockquote>
		</div>
		<?php } ?>
	<?php include('partials/footer.php'); ?>