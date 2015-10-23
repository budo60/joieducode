<?php
require_once 'partials/header.php';

// Récupérer les données du formulaire depuis le tableau $_POST
$firstname = !empty($_POST['firstname']) ? strip_tags($_POST['firstname']) : '';
$lastname = !empty($_POST['lastname']) ? strip_tags($_POST['lastname']) : '';
$gender = !empty($_POST['gender']) ? intval($_POST['gender']) : 0;
$email = !empty($_POST['email']) ? strip_tags($_POST['email']) : '';
$password = !empty($_POST['password']) ? strip_tags($_POST['password']) : '';
$confirm_password = !empty($_POST['confirm_password']) ? strip_tags($_POST['confirm_password']) : '';
$newsletter = !empty($_POST['newsletter']) ? intval($_POST['newsletter']) : 0;
$cgu = !empty($_POST['cgu']) ? intval($_POST['cgu']) : 0;

// Initialiser un tableau $errors et une chaine $result
$errors = array();
$result = '';

// Le formulaire a été soumis, l'utilisateur a appuyé sur Envoyer
if (!empty($_POST)) {

	// Vérifier que les champs obligatoires ne sont pas vides
	// Pour chaque erreur rencontrée, ajouter une entrée dans le tableau $errors correspondant au champ en erreur
	if (empty($firstname) || strlen($firstname) > 100) {
		$errors['firstname'] = 'Vous devez renseigner un prénom valide';
	}
	if (empty($lastname) || strlen($lastname) > 100) {
		$errors['lastname'] = 'Vous devez renseigner un nom valide';
	}
	if (empty($gender)) {
		$errors['gender'] = 'Vous devez renseigner un gender valide';
	}
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Vous devez renseigner un email valide';
	}
	if (strlen($password) < 6 || strlen($password) > 32) {
		$errors['password'] = 'Vous devez renseigner un password valide (longueur min 6, max 32)';
	} else {
		if (empty($confirm_password) || strcmp($password, $confirm_password) !== 0) {
			$errors['confirm_password'] = 'Vous devez confirmer votre mot de passe';
		}
	}
	if (empty($cgu)) {
		$errors['cgu'] = 'Vous devez accepter les CGU';
	}

	// On a aucune erreur, on peut faire la requête d'insertion
	if (empty($errors)) {

		// On va chercher un user corrspondant à l'email saisi
		$query = $db->prepare('SELECT id FROM users WHERE email  = :email');
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$user = $query->fetch();

		if (!empty($user)) {
			$errors['email'] = 'Cet email est déjà pris';
		} else {

			$crypted_password = password_hash($password, PASSWORD_BCRYPT);

			$query = $db->prepare('INSERT INTO users SET firstname = :firstname, lastname = :lastname, gender = :gender, email = :email, password = :password, newsletter = :newsletter, cdate = NOW()');
			$query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
			$query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
			$query->bindValue(':gender', $gender, PDO::PARAM_INT);
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->bindValue(':password', $crypted_password, PDO::PARAM_STR);
			$query->bindValue(':newsletter', $newsletter, PDO::PARAM_INT);
			$query->execute();

			// On récupère l'identifiant unique automatiquement généré par la requête
			$insert_id = $db->lastInsertId();

			//Si la requête a réussie (c.f. lastInsertId()), on affiche une confirmation à l'utilisateur
			if (!empty($insert_id)) {

				$user = array(
					'id' => $insert_id,
					'firstname' => $firstname,
					'lastname' => $lastname
				);

				$success = userLogin($user);

				$result .= '<div class="alert alert-success">Inscription réussie</div>';
				$result .= '<script>setTimeout(function() { location.href = "index.php"; }, 3000);</script>';
			} else {
				$result .= '<div class="alert alert-danger">Une erreur s\'est produite, merci de réessayer ultèrieurement</div>';
			}
		}
	}
}
//echo debug($_POST);
//echo debug($errors);
?>

		<h1>Inscription</h1>
		<hr>

		<?php if (!empty($errors)) { ?>
		<div class="alert alert-danger">
			<ul>
			<?php
			foreach($errors as $error) {
				echo '<li>'.$error.'</li>';
			}
			?>
			</ul>
		</div>
		<?php } ?>

		<?php
		if (!empty($result)) {
			echo $result;
		} else {
		?>
		<div class="card card-container">

			<form method="POST" class="form-register" novalidate>

				<div class="form-group">
					<label for="firstname">Prénom</label>
					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom" value="<?= $firstname ?>" autofocus>
				</div>

				<div class="form-group">
					<label for="lastname">Nom</label>
					<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Votre nom" value="<?= $lastname ?>">
				</div>

				<div class="form-group">
					<label for="gender">Sexe</label>
					<br>

					<?php
					foreach($genders as $gender_value => $gender_label) {
						$checked = $gender_value == $gender ? ' checked' : '';
					?>
					<label class="radio-inline">
						<input type="radio" name="gender" value="<?= $gender_value ?>"<?= $checked ?>> <?= $gender_label ?>
					</label>
					<?php } ?>

					<!--
					<label class="radio-inline">
						<input type="radio" name="gender" id="gender_male" value="1"<?= $gender == 1 ? ' checked' : ''?>> Homme
					</label>

					<label class="radio-inline">
						<input type="radio" name="gender" id="gender_female" value="1"<?= $gender == 2 ? ' checked' : ''?>> Femme
					</label>
					-->

				</div>

				<div class="form-group">
					<label for="email">Adresse email</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Un email valide" value="<?= $email ?>">
				</div>

				<div class="form-group">
					<label for="password">Mot de passe</label>
					<input type="password" id="password" name="password" class="form-control" placeholder="Un mot de passe de 6 caractères minimum">
				</div>

				<div class="form-group">
					<label for="password">Confirmation du mot de passe</label>
					<input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Répétez votre mot de passe">
				</div>

				<div class="checkbox">
					<label>
						<input name="newsletter" id="newsletter" type="checkbox" value="1"<?= ($newsletter ? ' checked' : '') ?>> Inscription à la newsletter
					</label>
				</div>

				<div class="checkbox">
					<label>
						<input name="cgu" id="cgu" type="checkbox" value="1"<?= ($cgu ? ' checked' : '') ?>> Accepter les CGU
					</label>
				</div>
				<br>

				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Inscription</button>

			</form><!-- /form -->

		</div><!-- /card-container -->
		<?php } ?>

<?php require_once 'partials/footer.php' ?>