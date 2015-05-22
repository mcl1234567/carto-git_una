<!DOCTYPE html>
<html dir="ltr" xml:lang="fr" lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>L'Unapei en chiffres</title>
		<link rel="icon" type="image/x-icon" href="<?php echo site_url(); ?>assets/images/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url(); ?>assets/images/favicon.ico" />
		<meta name="description" content="L'Unapei en chiffres">
		<meta name="keywords" content="Unapei;Chiffres">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link href="./assets/css/common.css" media="screen" type="text/css" rel="stylesheet"></link>
		<script src="./assets/javascript/jquery-1.11.0.min.js" type="text/javascript" style=""></script>
		<script src="./assets/javascript/jquery-ui.min.js" type="text/javascript"></script>
		<script src="./assets/javascript/markerclusterer.pack.js" type="text/javascript"></script>
		<script src="./assets/javascript/recherche.js" type="text/javascript"></script>
		<script src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false" type="text/javascript"></script>
		<script type="text/javascript">
			<?php
				$generer = 'var generer = "./genxml?chiffres=1';
				
				if($this->input->get('associations') OR $this->input->get('etablissements'))
				{
					if($this->input->get('etablissements') == 1)
					{
						$generer = 'var generer = "./genxml_etab?chiffres=1';
					}
					elseif($this->input->get('associations') == 1)
					{
						$generer = 'var generer = "./genxml_asso?chiffres=1';
					}
				}
				
				if($this->input->get())
				{
					$envoi = $this->input->get();
					foreach($envoi as $key => $value)
					{
						$generer .= '&'.$key.'='.$value;
					}
				}
				else
				{
					$key = 1;
				}
				echo $generer.'"';
			?>
			
			function load() {
				var centre = new google.maps.LatLng(46.0000, 2.0000);
				var mapOptions = {
					zoom: 5,
					center: centre
				};
				var map = new google.maps.Map(document.getElementById("map-canvas"),  mapOptions);
			
				var customIcons = {
					association: {
						icon: './assets/images/associations.png'
					},
					etablissement: {
						icon: './assets/images/etablissements.png'
					}
				};
				
				var clusters = [];
				var infoWindow = new google.maps.InfoWindow;
				var bounds  = new google.maps.LatLngBounds();
				
				var oms = new OverlappingMarkerSpiderfier(map, {
					markersWontMove: true, 
					markersWontHide: true,
					keepSpiderfied: true
				});
	
				downloadUrl(generer, function(data) {
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					
					for (var i = 0; i < markers.length; i++) {
							
						var name = markers[i].getAttribute("name");
						var adresseVoie = markers[i].getAttribute("adresseVoie");
						var adresse = markers[i].getAttribute("adresse");
						var BP = markers[i].getAttribute("BP");
						var adresseComplement = markers[i].getAttribute("adresseComplement");
						var CP = markers[i].getAttribute("CP");
						var ville = markers[i].getAttribute("ville");
						var telephone = markers[i].getAttribute("telephone");
						var telecopie = markers[i].getAttribute("telecopie");
						var courriel = markers[i].getAttribute("courriel");
						var internet = markers[i].getAttribute("internet");
						var type = markers[i].getAttribute("type");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng"))
						);
						
						if (adresseVoie != "") adresseVoie = "<li>" + adresseVoie + "</li>";
						if (adresse != "") adresse = "<li>" + adresse + "</li>";
						if (BP != "") BP = "<li>" + BP + "</li>";
						if (adresseComplement != "") adresseComplement = "<li>" + adresseComplement + "</li>";
						if (CP != "" || ville != "") CP = "<li>" + CP + " " + ville + "</li>";
						if (telephone != "") telephone = "<li>Tél : " + telephone + "</li>";
						if (telecopie != "") telecopie = "<li>Fax : " + telecopie + "</li>";
						if (courriel != "") courriel = "<li>Courriel : <a href='mailto:" + courriel + "'>" + courriel + "</a></li>";
						if (internet != "") internet = "<li>Site Internet : <a href='" + internet + "' target = '_blank'>" + internet + "</a></li>";
		
						var html = "<ul class='bubble'><li><strong>" + name + "</strong></li>" + adresseVoie + adresse + BP + adresseComplement + CP + telephone + telecopie + courriel + internet + "</ul>";
						var icon = customIcons[type] || {};
						var marker = new google.maps.Marker({
							map: map,
							position: point,
							icon: icon.icon
						});
						bounds.extend(marker.position);
						bindInfoWindow(marker, map, infoWindow, html);
						clusters.push(marker);
						oms.addMarker(marker);
					}

					var mcOptions = {gridSize: 16, maxZoom: 16};
					var markerCluster = new MarkerClusterer(map, clusters, mcOptions);
					map.fitBounds(bounds);
				});
				
				function bindInfoWindow(marker, map, infoWindow, html) {
					google.maps.event.addListener(marker, 'click', function() {
						infoWindow.setContent(html);
						infoWindow.open(map, marker);
					});
				}
	
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;
		
					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
				
					request.open('GET', url, true);
					request.send(null);
				}
				
				function doNothing() {}
			};
			google.maps.event.addDomListener(window, 'load', load);
		</script>
		<script src="./assets/javascript/oms.min.js" type="text/javascript"></script>
	</head>
	<body id="chiffres">
		<div class="page">
			<div class="actions">
				<section class="recherche">
					<header class="formulaire_header">
						<a href="#" class="plier"><img src="./assets/images/bouton_plier.png" width="14" height="14" alt="Plier" /></a>
						<h1>Vous recherchez des associations, <br/>des établissements ou des services…</h1>
					</header>
					<div id="formulaire">
						<ul class="chiffres">					
							<li><strong>550</strong> associations adhérentes</li>
							<li><strong>60 000</strong> familles adhérentes</li>
							<li><strong>71 500</strong> bénévoles</li>
							<li><strong>180 000</strong> personnes handicapées accompagnées</li>
							<li><strong>70 000</strong> majeurs protégés</li>
							<li><strong>3100</strong> établissements et services médico-sociaux</li>
							<li><strong>80 000</strong> professionnels</li>
						</ul>
						<form method="get" action="<?php echo current_url(); ?>">
						<ul class="limiter">
							<li <?php if(!$this->input->get() OR $value == '') echo 'class="on" '; ?>><button role="button" value="" type="submit" name="tout">Tout voir</button></li>
							<li <?php if($key == 'associations' AND $value == 1) echo 'class="on" '; ?>><button role="button" value="<?php if($key == 'associations' AND $value == 1) echo 0; else echo 1; ?>" type="submit" name="associations">Voir les associations</button></li>
							<li <?php if($key == 'etablissements' AND $value == 1) echo 'class="on" '; ?>><button role="button" value="<?php if($key == 'etablissements' AND $value == 1) echo 0; else echo 1; ?>" type="submit" name="etablissements">Voir les établissements et services</button></li>
						</ul>
						</form>
					</div>
				</section>
			</div>
		</div>
		<div id="map-canvas"></div>	
	</body>
</html>