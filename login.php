<?php
require_once 'partials/header.php';

//echo debug($_POST);

$email = !empty($_POST['email']) ? strip_tags($_POST['email']) : '';
$password = !empty($_POST['password']) ? strip_tags($_POST['password']) : '';

$error = false;
$success = false;
if (!empty($_POST)) {

	if (empty($email) || empty($password)) {
		$error = true;
	} else {

		// On va chercher un user corrspondant à l'email saisi
		$query = $db->prepare('SELECT * FROM users WHERE email  = :email');
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();

		if ($query->rowCount() == 0) {
			$error = true;
		} else {
			$user = $query->fetch();
			//echo debug($user);

			if (password_verify($password, $user['password'])) {
				$success = userLogin($user);
			} else {
				$error = true;
			}
		}
	}
}
?>
		<h1>Connexion</h1>
		<hr>

		<div class="card card-container">

			<?php if ($error === true) { ?>
			<div class="alert alert-danger">
				Identifiants incorrects
			</div>
			<?php } ?>

			<?php if ($success === true) { ?>
				<div class="alert alert-success">Connexion réussie</div>
				<script>setTimeout(function() { location.href = "index.php"; }, 3000);</script>
			<?php } else { ?>
			<form class="form-login" method="POST" novalidate>

				<input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
				<br>
				<input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required>

				<div id="remember" class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Se souvenir de moi
					</label>
				</div>

				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Connexion</button>

			</form><!-- /form -->

			<a href="#" class="forgot-password">
				Mot de passe oublié ?
			</a>
			<?php } ?>
		</div><!-- /card-container -->


<?php require_once 'partials/footer.php' ?>