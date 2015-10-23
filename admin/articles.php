<?php
	include('partials/header.php');

	$sql = 'SELECT * FROM articles ORDER BY id DESC';
	$query = $db->query($sql);
	$articles = $query->fetchAll();

?>

		<h1>Articles</h1>
		<hr>

		<table id="table-dynamic" class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Auteur</th>
					<th>Contenu</th>
					<th>Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($articles as $article) { ?>
				<tr>
					<td><?= $article['id'] ?></td>
					<td><?= ucfirst($article['name']) ?></td>
					<td><?= cutstring($article['content'],50) ?></td>
					<td><?= getFormatDate($article['creation_date'],'d/m/Y H:i:s') ?></td>
					<td></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

<?php include('partials/footer.php') ?>