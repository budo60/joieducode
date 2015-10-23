<?php

	include_once('partials/header.php');

	$sql = 'SELECT COUNT(*) as nb FROM articles';
	$query = $db->query($sql);
	$count = $query->fetch();
	$count_jdc = $count['nb'];

	$sql = 'SELECT COUNT(*) as nb FROM users';
	$query = $db->query($sql);
	$count = $query->fetch();
	$count_users = $count['nb'];

	$count_messages = 0;
	$count_comments = 0;

	$sql = 'SELECT * FROM articles ORDER BY id DESC LIMIT 5';
	$query = $db->query($sql);
	$last_jdc = $query->fetchAll();

	$sql = 'SELECT * FROM users ORDER BY id DESC LIMIT 5';
	$query = $db->query($sql);
	$last_users = $query->fetchAll();

?>

				<h1 class="page-header">Tableau de bord</h1>

				<div class="row placeholders">
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/sky/text:<?= $count_jdc ?> \n JDC" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre de JDC</h4>
					</div>
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/vine/text:<?= $count_users ?> \n inscriptions" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre d'inscriptions</h4>
					</div>
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/social/text:<?= $count_comments ?> \n commentaires" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre de commentaires</h4>
					</div>
					<div class="col-xs-6 col-sm-3 placeholder">
						<img data-src="holder.js/200x200/auto/#5bc0de:#fff/text:<?= $count_messages ?> \n messages" class="img-responsive" alt="Generic placeholder thumbnail">
						<h4>Nombre de messages</h4>
					</div>
				</div>

				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Dernières JDC</h3>
					</div>
					<div class="list-group">
					<?php foreach($last_jdc as $jdc) { ?>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading"><?= $jdc['name'] ?> (<?= getFormatDate($jdc['creation_date']) ?>)</h4>
							<p class="list-group-item-text"><?= cutString($jdc['content'],150) ?></p>
						</a>
						<?php } ?>
					</div>
				</div>

				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Dernières inscriptions</h3>
					</div>
					<div class="list-group">
					<?php foreach($last_users as $users) { ?>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading"><?= user_getFullName($users) ?> (<?= user_getGenderLabel($users['gender']) ?>)</h4>
							<p class="list-group-item-text">Inscrit le <?= getFormatDate($users['cdate'],'d/m/Y \à H:i:s') ?></p>
						</a>
						<?php } ?>
					</div>
				</div>

			</div>

			<?php include_once('partials/sidebar.php') ?>

		</div><!--/.row -->
<?php	include_once('partials/footer.php') ?>