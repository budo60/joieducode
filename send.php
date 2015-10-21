<?php

	include_once('partials/header.php');

	$name = (!empty($_POST['name'])) ? strip_tags($_POST['name']): '';
	$content = (!empty($_POST['content'])) ? strip_tags($_POST['content']): '';

	if (!empty($_POST)) {
		$errors = array();
		$result ='';
		if (empty($name) || strlen($name) > 100) {
			$errors['name'] = 'Vous devez renseignez votre nom (100 caracteres max)';
		}
		if (empty($content) || strlen($content) < 10) {
			$errors['name'] = 'Vous devez renseignez votre JDC (10 caracteres min)';
		}

		if(empty($errors)){
			$sql = 'INSERT INTO article (name,content,creation_date) VALUES (:name,:content,NOW())';
			$query = $db->prepare($sql);
			$query->bindValue('name',$name,PDO::PARAM_STR);
			$query->bindValue('content',$content,PDO::PARAM_STR);
			$query->execute();

			$last_id = $db->lastInsertId();
			if (!empty($last_id)) {

			$result .= '<div class="alert alert-success">Votre JDC a bien été envoyé</div>';
			$result .= '<a href="article.php?id='.$last_id.'">Votre JDC</a>';

			} else {
			$result .= '<div class="alert alert-danger">une erreur s\'est produite, merci de réessayer ultérieurement</div>';
			}
		}
		echo $result;


	}

?>

	<h1>Envoyez votre Joie du code</h1>

	<hr>

	<form action="send.php" method="POST">
		<div class="form-group">
			<label for="name">Votre nom</label>
			<input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" placeholder="Entrez votre nom">
		</div>
		<div class="form-group">
			<label for="content">Votre Joie de code</label>
			<textarea name="content" id="content" class="form-control" rows="5" placeholder="Contenu de votre Joie de code"><?= $content ?></textarea>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>

<?php include_once('partials/footer.php'); ?>