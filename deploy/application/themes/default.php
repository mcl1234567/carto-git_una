<!DOCTYPE html>
<html dir="ltr" xml:lang="fr" lang="fr">
	<head>
		<meta charset="<?php echo $charset; ?>">
		<title><?php echo $title; ?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo site_url(); ?>assets/images/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url(); ?>assets/images/favicon.ico" />
		<meta name="description" content="<?php echo $description; ?>">
		<meta name="keywords" content="<?php echo $keywords; ?>">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<?php foreach($css as $url): ?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
		<?php endforeach; ?>

		<?php foreach($js as $url): ?>
		<script type="text/javascript" src="<?php echo $url; ?>"></script>
		<?php endforeach; ?>

		<?php if($page == 'recherche'): ?>
		<script src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false" type="text/javascript"></script>
		
		<script type="text/javascript">
			$(function() {
				var nomsRegions = [
					<?php
						$query_region_length = $query_region->num_rows();
						$i = 0;
						foreach($query_region->result() as $row)
						{
							$i++;
							echo '"'.ucwords(strtolower($row->nomRegion)).'"';
							if($i < $query_region_length) echo ',';
						}
					?>
				];
				var numerosDepartements = [
					<?php
						$query_departement_length = $query_departement->num_rows();
						$i = 0;
						foreach($query_departement->result() as $row)
						{
							$i++;
							echo '"'.$row->codeDepartement.'"';
							echo ',';
							echo '"'.ucwords(strtolower($row->nomDepartement)).'"';
							if($i < $query_departement_length) echo ',';
						}
					?>
				];
				$( "#champ_region, #champ_region_etendu" ).autocomplete({
					source: nomsRegions
				});
				$( "#champ_departement, #champ_departement_etendu" ).autocomplete({
					source: numerosDepartements
				});
				$( "#champ_ville, #champ_ville_etendu" ).autocomplete({
					source: "./ville",
					minLength: 2
				});

				<?php
					if($this->input->post())
					{
						echo "var actif = $('.liste .choix.actif').index();";
						echo "$('.choix.actif').addClass('on');";
						echo "$('.liste').accordion({ header:'.header', collapsible:true, heightStyle:'content', active:actif });";
					}
				?>
			});

			<?php
				if($this->input->post())
				{
					if($query AND $query->num_rows() > 0)
					{
						$envoi = $this->input->post();
						$generer = 'var generer = "./genxml?';
						foreach($envoi as $key => $value)
						{
							if($this->input->post('recherche_etendue'))
							{
								if(preg_match('/departement/', $key)) $value = str_replace('departement_', '', $key);
								if(preg_match('/region/', $key)) $value = str_replace('region_', '', $key);
								if(preg_match('/typeAsso/', $key)) $value = str_replace('typeAsso_', '', $key);
								if(preg_match('/typeEtab/', $key)) $value = str_replace('typeEtab_', '', $key);
								if(preg_match('/typeActivite/', $key)) $value = str_replace('typeActivite_', '', $key);
								if(preg_match('/etabPlaces/', $key)) $value = str_replace('typeAge_', '', $key);
							}

							$generer .= $key.'='.$value.'&';
						}
						echo $generer.'"';
					}
				}
			?>

			function load()
			{
				var centre = new google.maps.LatLng(46.5397, 2.4303);
				var mapOptions = {
					zoom: 6,
					center: centre
				};
				map = new google.maps.Map(document.getElementById("map-canvas"),  mapOptions);

				<?php if($this->input->post()): ?>

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

				<?php if($query AND $query->num_rows() > 0) : ?>
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
						marker = new google.maps.Marker({
							map: map,
							position: point,
							icon: icon.icon
						});
						bounds.extend(marker.position);
						bindInfoWindow(marker, map, infoWindow, html);
						clusters.push(marker);
						oms.addMarker(marker);
					}

					var mcOptions = {gridSize: 26, maxZoom: 16};
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
				<?php endif; ?>

				function doNothing() {}
				<?php endif; ?>

				$('#masqueChargement').hide();
			};
			google.maps.event.addDomListener(window, 'load', load);

			$(function() {
				$(".geo").click(function() {
					var lat = $(this).attr('data-lat');
					var lon = $(this).attr('data-lon');
					var latLng = new google.maps.LatLng(lat, lon);
					map.panTo(latLng);
					map.setZoom(16);
				});
			});
		</script>
		<script src="./assets/javascript/oms.min.js" type="text/javascript"></script>
		<?php endif; ?>

	</head>
	<body id="<?php echo $page; ?>">
		<div class="page">
			<div class="<?php if($page != 'recherche') echo 'content'; else echo 'actions'; ?>">
				<?php echo $output; ?>
			</div>
		</div>

		<?php if($page == 'recherche'): ?>
		<div id="map-canvas"></div>
		<?php endif; ?>

		<footer class="footer">
			<ul>
				<li<?php if($page == 'accueil') echo ' class="on"'; ?>><a href="<?php echo site_url(); ?>">Accueil</a></li>
				<li<?php if($page == 'recherche') echo ' class="on"'; ?>><a href="<?php echo site_url('recherche'); ?>">Recherche</a></li>
				<li<?php if($page == 'mentions') echo ' class="on"'; ?>><a href="<?php echo site_url('mentions'); ?>">Mentions légales</a></li>
				<li<?php if($page == 'credits') echo ' class="on"'; ?>><a href="<?php echo site_url('credits'); ?>">Crédits</a></li>
				<li><a href="http://www.unapei.org" title="Site Internet de l'Unapei" target="_blank"><?php echo img('logo_footer.png','Unapei.org',241,55); ?></a></li>
			</ul>
		</footer>
	</body>
</html>
