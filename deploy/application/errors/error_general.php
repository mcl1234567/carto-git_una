<!DOCTYPE html>
<html dir="ltr" xml:lang="fr" lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Erreur</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link href="<?php echo site_url(); ?>assets/css/common.css" media="screen" type="text/css" rel="stylesheet"></link>
		<style type="text/css">
		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}
		</style>
	</head>
	<body id="mentions">
		<div class="page">
			<div class="content">
				<header><img src="<?php echo site_url(); ?>assets/images/logo.png" width="289" height="80" alt="Unapei" /></header>
				<div class="chapo">
					<h1 lang="en"><?php echo $heading; ?></h1>
					<p lang="en"><?php echo $message; ?></p>
				</div>
			</div>
		</div>
		<footer class="footer">
			<ul>
				<li><a href="<?php echo site_url(); ?>">Accueil</a></li>
				<li><a href="<?php echo site_url(); ?>recherche">Recherche</a></li>
				<li><a href="<?php echo site_url(); ?>mentions">Mentions légales</a></li>
				<li><a href="<?php echo site_url(); ?>credits">Crédits</a></li>
				<li><a href="http://www.unapei.org" title="Site Internet de l'Unapei" target="_blank"><img src="<?php echo site_url(); ?>assets/images/logo_footer.png" alt="Unapei.org" width="241" height="55" /></a></li>
			</ul>
		</footer>
	</body>
</html>