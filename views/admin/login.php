<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="<?php echo getUrl('assets/css/admin.css') ?>">
	<script type="text/javascript" src="<?php echo getUrl('assets/js/admin.js') ?>"></script>
</head>

<body>
	<div class="login_container">
		<h2>Faça o Login</h2>
		<form action="auth" method="post" class="login_content">
			<div>
				<input type="email" name="email" placeholder="Digite seu e-mail" required>
			</div>
			<div>
				<input type="password" name="password" placeholder="Digite sua senha" required>
			</div>
			<div>
				<button class="btn_login">Entrar</button>
			</div>
		</form>
	</div>
	<?php if (isset($_SESSION['token_status'])) : ?>

		<div class="message_warging <?php echo isset($_SESSION['token_status']) ? $_SESSION['token_status'] : ''; ?>">
			<p><?php echo isset($_SESSION['token_message']) ? $_SESSION['token_message'] : ''; ?></p>
			<h1><?php echo $_SESSION['token_status']; ?></h1>
			<?php
			unset($_SESSION['token_message']);
			unset($_SESSION['token_status']);
			?>
		</div>
	<?php endif; ?>
</body>

</html>