<?php

	$chemin = 'http://'.$_SERVER['HTTP_HOST'].str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); 

?>

<!DOCTYPE html>
<html dir="ltr" xml:lang="fr" lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>404 Page non trouvée</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link href="<?php echo $chemin; ?>assets/css/common.css" media="screen" type="text/css" rel="stylesheet"></link>
	</head>
	<body id="mentions">
		<div class="page">
			<div class="content">
				<header><img src="<?php echo $chemin; ?>assets/images/logo.png" width="289" height="80" alt="Unapei" /></header>
				<div class="chapo">
					<h1>Erreur 404 : page non trouvée</h1>

					<p>La page que vous recherchez n'a pas été trouvée sur le site.</p>
				</div>
			</div>
		</div>
		<footer class="footer">
			<ul>
				<li><a href="<?php echo $chemin; ?>">Accueil</a></li>
				<li><a href="<?php echo $chemin; ?>recherches">Recherche</a></li>
				<li><a href="<?php echo $chemin; ?>mentions">Mentions légales</a></li>
				<li><a href="<?php echo $chemin; ?>credits">Crédits</a></li>
				<li><a href="http://www.unapei.org" title="Site Internet de l'Unapei" target="_blank"><img src="<?php echo $chemin; ?>assets/images/logo_footer.png" alt="Unapei.org" width="241" height="55" /></a></li>
			</ul>
		</footer>
	</body>
</html>
