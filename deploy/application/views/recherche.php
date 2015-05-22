<div id="masqueChargement"></div>
<section class="recherche">
	<header class="formulaire_header">
		<a href="#" class="plier"><img src="./assets/images/bouton_plier.png" width="14" height="14" alt="Plier" /></a>
		<h1>Vous recherchez des associations, <br/>des établissements ou des services…</h1>
	</header>
	<div id="formulaire">
		<ul class="liste">

			<!-- Chercher une association -->
			<li class="choix recherche_avancee <?php if($this->input->post('recherche_etendue')) echo 'actif'; ?>">
				<?php echo form_open(current_url()); ?>
					<div class="header">
						<h2>Chercher une association</h2>
						<a href="#ancre1" class="info" title="Ici, vous pouvez saisir simultanément plusieurs paramètres pour faciliter votre recherche."><?php echo img('info_off.png','Informations',21,21); ?></a>
					</div>
					<div id="ancre1">
						<!-- Début type association -->
						<fieldset class="selection">
							<legend>Filtrer les associations par type</legend>
							<h3>Sélectionner un type d'association</h3>
							<ul class="typeAsso_selection">
								<?php foreach($query_typeAsso->result() as $row) : ?>
								<?php if(!$this->input->post('typeAsso_'.$row->code)) : ?>
								<li role="button">
									<input id="champ_departement_typeAsso_<?php echo $row->code; ?>" type="checkbox" name="typeAsso_<?php echo $row->code; ?>" value="<?php echo $row->code; ?>" />
									<label for="champ_departement_typeAsso_<?php echo $row->code; ?>"><?php echo $row->nom; ?></label>
									<?php echo $row->nom; ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="typeAsso_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/typeAsso/', $key)) : ?>
						<?php $value = str_replace('typeAsso_', '', $key); ?>
							<li role="button">
								<input id="champ_typeAsso_<?php echo $value; ?>" type="hidden" name="typeAsso_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_typeAsso_<?php echo $value; ?>"><?php echo $this->model_form->lire_typeAsso($value)->row('nom'); ?></label>
								<?php echo $this->model_form->lire_typeAsso($value)->row('nom'); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin type association -->

						<!-- Début défaut -->
						<fieldset>
							<legend>Critères de recherche par défaut</legend>
							<ul class="defaut_selection">
								<li>
									<label for="champ_distance_etendu">Distance (en KM)</label>
									<input id="champ_distance_etendu" type="text" name="distance_etendu" <?php if($this->input->post('distance_etendu')) echo 'value="'.$this->input->post('distance_etendu').'"'; ?> />
									<input id="champ_localisation_etendu" type="hidden" name="localisation_etendu" value="<?php if($this->input->post('localisation_etendu')) echo $this->input->post('localisation_etendu'); ?>" />
								</li>
								<li>
									<label for="champ_ville_etendu">Nom de ville ou code postal</label>
									<input id="champ_ville_etendu" type="text" name="ville_etendu" <?php if($this->input->post('ville_etendu')) echo 'value="'.$this->input->post('ville_etendu').'"'; ?> />
								</li>
								<li>
									<label for="champ_mot_etendu">Mot clé</label>
									<input id="champ_mot_etendu" type="text" name="mot_etendu" <?php if($this->input->post('mot_etendu')) echo 'value="'.$this->input->post('mot_etendu').'"'; ?> />
								</li>
							</ul>
						</fieldset>
						<!-- Fin défaut -->

						<!-- Début région étendue -->
						<fieldset class="selection">
							<legend>Rechercher plusieurs régions</legend>
							<h3>Sélectionner plusieurs régions</h3>
							<ul class="regions_selection">
								<?php foreach($query_region->result() as $row) : ?>
								<?php if(!$this->input->post('region_'.$row->codeRegion)) : ?>
								<li role="button">
									<input id="champ_region_<?php echo $row->codeRegion; ?>" type="checkbox" name="region_<?php echo $row->codeRegion; ?>" value="<?php echo $row->codeRegion; ?>" />
									<label for="champ_region_<?php echo $row->codeRegion; ?>"><?php echo ucwords(strtolower($row->nomRegion)); ?></label>
									<?php echo ucwords(strtolower($row->nomRegion)); ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="regions_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/region/', $key)) : ?>
						<?php $value = str_replace('region_', '', $key); ?>
							<li role="button">
								<input id="champ_region_<?php echo $value; ?>" type="hidden" name="region_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_region_<?php echo $value; ?>"><?php echo ucwords(strtolower($this->model_form->lire_region($value)->row('nomRegion'))); ?></label>
								<?php echo ucwords(strtolower($this->model_form->lire_region($value)->row('nomRegion'))); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin région étendue -->

						<!-- Début département étendu -->
						<fieldset class="selection">
							<legend>Rechercher plusieurs départements</legend>
							<h3>Sélectionner plusieurs départements</h3>
							<ul class="departements_selection">
								<?php foreach($query_departement->result() as $row) : ?>
								<?php if(!$this->input->post('departement_'.$row->codeDepartement)) : ?>
								<li role="button">
									<input id="champ_departement_<?php echo $row->codeDepartement; ?>" type="checkbox" name="departement_<?php echo $row->codeDepartement; ?>" value="<?php echo $row->codeDepartement; ?>" />
									<label for="champ_departement_<?php echo $row->codeDepartement; ?>"><?php echo ucwords(strtolower($row->nomDepartement)); ?></label>
									<?php echo ucwords(strtolower($row->nomDepartement)); ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="departements_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/departement/', $key)) : ?>
						<?php $value = str_replace('departement_', '', $key); ?>
							<li role="button">
								<input id="champ_departement_<?php echo $value; ?>" type="hidden" name="departement_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_departement_<?php echo $value; ?>"><?php echo ucwords(strtolower($this->model_form->lire_departement($value)->row('nomDepartement'))); ?></label>
								<?php echo ucwords(strtolower($this->model_form->lire_departement($value)->row('nomDepartement'))); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin département étendu -->

						<!-- Début type activité -->
						<fieldset class="selection">
							<legend>Filtrer les activités par type</legend>
							<h3>Sélectionner un type d'activité</h3>
							<ul class="typeActivite_selection">
								<?php foreach($query_typeActivite->result() as $row) : ?>
								<?php if(!$this->input->post('typeActivite_'.$row->code)) : ?>
								<li role="button">
									<input id="champ_typeActivite_<?php echo $row->code; ?>" type="checkbox" name="typeActivite_<?php echo $row->code; ?>" value="<?php echo $row->code; ?>" />
									<label for="champ_typeActivite_<?php echo $row->code; ?>"><?php echo $row->libelle; ?></label>
									<?php echo $row->libelle; ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="typeActivite_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/typeActivite/', $key)) : ?>
						<?php $value = str_replace('typeActivite_', '', $key); ?>
							<li role="button">
								<input id="champ_typeActivite_<?php echo $value; ?>" type="hidden" name="typeActivite_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_typeActivite_<?php echo $value; ?>"><?php echo $this->model_form->lire_typeActivite($value)->row('libelle'); ?></label>
								<?php echo $this->model_form->lire_typeActivite($value)->row('libelle'); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin type activité -->

						<!-- Début type âge -->
						<fieldset class="selection">
							<legend>Filtrer les classes d'âge par type</legend>
							<h3>Places par classe d'âge</h3>
							<?php
								$typeAge_tab = array(
									'etabPlaces0a6ans' => 'De 0 à 6 ans',
									'etabPlaces7a15ans' => 'De 7 à 15 ans',
									'etabPlaces16a20ans' => 'De 16 à 20 ans',
									'etabPlaces21a45ans' => 'De 21 à 45 ans',
									'etabPlaces46a55ans' => 'De 46 à 55 ans',
									'etabPlaces56a59ans' => 'De 56 à 59 ans',
									'etabPlaces60ansPlus' => 'De 60 ans et plus'
								);
							?>
							<ul class="typeAge_selection">
								<?php foreach($typeAge_tab as $key => $value) : ?>
								<?php if(!$this->input->post('typeAge_'.$key)) : ?>
								<li role="button">
									<input id="champ_typeAge_<?php echo $key; ?>" type="checkbox" name="typeAge_<?php echo $key; ?>" value="<?php echo $key; ?>" />
									<label for="champ_typeAge_<?php echo $key; ?>"><?php echo $value; ?></label>
									<?php echo $value; ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="typeAge_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/typeAge/', $key)) : ?>
						<?php $value = str_replace('typeAge_', '', $key); ?>
							<li role="button">
								<input id="champ_typeAge_<?php echo $value; ?>" type="hidden" name="typeAge_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_typeAge_<?php echo $value; ?>"><?php foreach($typeAge_tab as $cle => $valeur) if($value == $cle) echo $valeur; ?></label>
								<?php foreach($typeAge_tab as $cle => $valeur) if($value == $cle) echo $valeur; ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin type âge -->
						<input type="hidden" name="recherche_etendue" value="plus" />
						<p class="bouton clear"><input type="submit" value="Valider" /></p>
					</div>
				</form>
			</li>

      <!-- Chercher un établissement -->
			<li class="choix recherche_avancee <?php if($this->input->post('recherche_etendue')) echo 'actif'; ?>">
				<?php echo form_open(current_url()); ?>
					<div class="header">
						<h2>Chercher un établissement</h2>
						<a href="#ancre1" class="info" title="Ici, vous pouvez saisir simultanément plusieurs paramètres pour faciliter votre recherche."><?php echo img('info_off.png','Informations',21,21); ?></a>
					</div>
					<div id="ancre1">
						<!-- Début type établissement -->
						<fieldset class="selection">
							<legend>Filtrer les établissements par type</legend>
							<h3>Sélectionner un type d'établissement</h3>
							<ul class="typeEtab_selection">
								<?php foreach($query_typeEtab->result() as $row) : ?>
								<?php if(!$this->input->post('typeEtab_'.$row->code)) : ?>
								<li role="button">
									<input id="champ_typeEtab_<?php echo $row->code; ?>" type="checkbox" name="typeEtab_<?php echo $row->code; ?>" value="<?php echo $row->code; ?>" />
									<label for="champ_typeEtab_<?php echo $row->code; ?>" title="<?php echo $row->description; ?>"><?php echo character_limiter($row->libelle, 25); ?></label>
									<?php echo character_limiter($row->libelle, 25); ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="typeEtab_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/typeEtab/', $key)) : ?>
						<?php $value = str_replace('typeEtab_', '', $key); ?>
							<li role="button">
								<input id="champ_typeEtab_<?php echo $value; ?>" type="hidden" name="typeEtab_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_typeEtab_<?php echo $value; ?>"><?php echo character_limiter($this->model_form->lire_typeEtab($value)->row('libelle'), 25); ?></label>
								<?php echo character_limiter($this->model_form->lire_typeEtab($value)->row('libelle'), 25); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin type établissement -->

						<!-- Début défaut -->
						<fieldset>
							<legend>Critères de recherche par défaut</legend>
							<ul class="defaut_selection">
								<li>
									<label for="champ_distance_etendu">Distance (en KM)</label>
									<input id="champ_distance_etendu" type="text" name="distance_etendu" <?php if($this->input->post('distance_etendu')) echo 'value="'.$this->input->post('distance_etendu').'"'; ?> />
									<input id="champ_localisation_etendu" type="hidden" name="localisation_etendu" value="<?php if($this->input->post('localisation_etendu')) echo $this->input->post('localisation_etendu'); ?>" />
								</li>
								<li>
									<label for="champ_ville_etendu">Nom de ville ou code postal</label>
									<input id="champ_ville_etendu" type="text" name="ville_etendu" <?php if($this->input->post('ville_etendu')) echo 'value="'.$this->input->post('ville_etendu').'"'; ?> />
								</li>
								<li>
									<label for="champ_mot_etendu">Mot clé</label>
									<input id="champ_mot_etendu" type="text" name="mot_etendu" <?php if($this->input->post('mot_etendu')) echo 'value="'.$this->input->post('mot_etendu').'"'; ?> />
								</li>
							</ul>
						</fieldset>
						<!-- Fin défaut -->

						<!-- Début région étendue -->
						<fieldset class="selection">
							<legend>Rechercher plusieurs régions</legend>
							<h3>Sélectionner plusieurs régions</h3>
							<ul class="regions_selection">
								<?php foreach($query_region->result() as $row) : ?>
								<?php if(!$this->input->post('region_'.$row->codeRegion)) : ?>
								<li role="button">
									<input id="champ_region_<?php echo $row->codeRegion; ?>" type="checkbox" name="region_<?php echo $row->codeRegion; ?>" value="<?php echo $row->codeRegion; ?>" />
									<label for="champ_region_<?php echo $row->codeRegion; ?>"><?php echo ucwords(strtolower($row->nomRegion)); ?></label>
									<?php echo ucwords(strtolower($row->nomRegion)); ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="regions_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/region/', $key)) : ?>
						<?php $value = str_replace('region_', '', $key); ?>
							<li role="button">
								<input id="champ_region_<?php echo $value; ?>" type="hidden" name="region_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_region_<?php echo $value; ?>"><?php echo ucwords(strtolower($this->model_form->lire_region($value)->row('nomRegion'))); ?></label>
								<?php echo ucwords(strtolower($this->model_form->lire_region($value)->row('nomRegion'))); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin région étendue -->

						<!-- Début département étendu -->
						<fieldset class="selection">
							<legend>Rechercher plusieurs départements</legend>
							<h3>Sélectionner plusieurs départements</h3>
							<ul class="departements_selection">
								<?php foreach($query_departement->result() as $row) : ?>
								<?php if(!$this->input->post('departement_'.$row->codeDepartement)) : ?>
								<li role="button">
									<input id="champ_departement_<?php echo $row->codeDepartement; ?>" type="checkbox" name="departement_<?php echo $row->codeDepartement; ?>" value="<?php echo $row->codeDepartement; ?>" />
									<label for="champ_departement_<?php echo $row->codeDepartement; ?>"><?php echo ucwords(strtolower($row->nomDepartement)); ?></label>
									<?php echo ucwords(strtolower($row->nomDepartement)); ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="departements_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/departement/', $key)) : ?>
						<?php $value = str_replace('departement_', '', $key); ?>
							<li role="button">
								<input id="champ_departement_<?php echo $value; ?>" type="hidden" name="departement_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_departement_<?php echo $value; ?>"><?php echo ucwords(strtolower($this->model_form->lire_departement($value)->row('nomDepartement'))); ?></label>
								<?php echo ucwords(strtolower($this->model_form->lire_departement($value)->row('nomDepartement'))); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin département étendu -->

						<!-- Début type activité -->
						<fieldset class="selection">
							<legend>Filtrer les activités par type</legend>
							<h3>Sélectionner un type d'activité</h3>
							<ul class="typeActivite_selection">
								<?php foreach($query_typeActivite->result() as $row) : ?>
								<?php if(!$this->input->post('typeActivite_'.$row->code)) : ?>
								<li role="button">
									<input id="champ_typeActivite_<?php echo $row->code; ?>" type="checkbox" name="typeActivite_<?php echo $row->code; ?>" value="<?php echo $row->code; ?>" />
									<label for="champ_typeActivite_<?php echo $row->code; ?>"><?php echo $row->libelle; ?></label>
									<?php echo $row->libelle; ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="typeActivite_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/typeActivite/', $key)) : ?>
						<?php $value = str_replace('typeActivite_', '', $key); ?>
							<li role="button">
								<input id="champ_typeActivite_<?php echo $value; ?>" type="hidden" name="typeActivite_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_typeActivite_<?php echo $value; ?>"><?php echo $this->model_form->lire_typeActivite($value)->row('libelle'); ?></label>
								<?php echo $this->model_form->lire_typeActivite($value)->row('libelle'); ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin type activité -->

						<!-- Début type âge -->
						<fieldset class="selection">
							<legend>Filtrer les classes d'âge par type</legend>
							<h3>Places par classe d'âge</h3>
							<?php
								$typeAge_tab = array(
									'etabPlaces0a6ans' => 'De 0 à 6 ans',
									'etabPlaces7a15ans' => 'De 7 à 15 ans',
									'etabPlaces16a20ans' => 'De 16 à 20 ans',
									'etabPlaces21a45ans' => 'De 21 à 45 ans',
									'etabPlaces46a55ans' => 'De 46 à 55 ans',
									'etabPlaces56a59ans' => 'De 56 à 59 ans',
									'etabPlaces60ansPlus' => 'De 60 ans et plus'
								);
							?>
							<ul class="typeAge_selection">
								<?php foreach($typeAge_tab as $key => $value) : ?>
								<?php if(!$this->input->post('typeAge_'.$key)) : ?>
								<li role="button">
									<input id="champ_typeAge_<?php echo $key; ?>" type="checkbox" name="typeAge_<?php echo $key; ?>" value="<?php echo $key; ?>" />
									<label for="champ_typeAge_<?php echo $key; ?>"><?php echo $value; ?></label>
									<?php echo $value; ?>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</fieldset>
						<ul class="typeAge_drop drop">
						<?php if($this->input->post()) : ?>
						<?php foreach($this->input->post() as $key => $value) : ?>
						<?php if(preg_match('/typeAge/', $key)) : ?>
						<?php $value = str_replace('typeAge_', '', $key); ?>
							<li role="button">
								<input id="champ_typeAge_<?php echo $value; ?>" type="hidden" name="typeAge_<?php echo $value; ?>" value="<?php echo $value; ?>" />
								<label for="champ_typeAge_<?php echo $value; ?>"><?php foreach($typeAge_tab as $cle => $valeur) if($value == $cle) echo $valeur; ?></label>
								<?php foreach($typeAge_tab as $cle => $valeur) if($value == $cle) echo $valeur; ?>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						</ul>
						<!-- Fin type âge -->
						<input type="hidden" name="recherche_etendue" value="plus" />
						<p class="bouton clear"><input type="submit" value="Valider" /></p>
					</div>
				</form>
			</li>

      <!-- A proximité ? -->
			<li class="choix localisation <?php if($this->input->post('distance') OR $this->input->post('localisation')) echo 'actif'; ?>">
				<?php echo form_open(current_url()); ?>
					<div class="header">
						<h2>À proximité ?</h2>
						<a href="#ancre2" class="info" title="Ici, vous pouvez utiliser votre position GPS pour trouver une association ou un établissement."><?php echo img('info_off.png','Informations',21,21); ?></a>
					</div>
					<div id="ancre2">
						<!-- Début proximité -->
						<?php
							if($this->input->post('distance'))
							{
								$radius = $this->input->post('distance');
								$radius = preg_replace('/\D[^.,]/', '', $radius);
							}
						?>
						<fieldset class="champ">
							<legend>Sélectionner des associations à proximité</legend>
							<ul>
								<li>
									<label for="champ_distance">Distance</label>
									<input id="champ_distance" type="text" name="distance" placeholder="Á quelle distance (en KM) ?" required <?php if($this->input->post('distance')) echo 'value="'.$radius.'"'; ?> />
									<input id="champ_localisation" type="hidden" name="localisation" value="<?php if($this->input->post('localisation')) echo $this->input->post('localisation'); ?>" />
								</li>
							</ul>
						</fieldset>
						<!-- Fin proximité -->
						<p class="bouton"><input type="submit" value="Valider" /></p>
					</div>
				</form>
			</li>

      <!-- Dans votre ville ? -->
			<li class="choix ville <?php if($this->input->post('ville')) echo 'actif'; ?>">
				<?php echo form_open(current_url()); ?>
					<div class="header">
						<h2>Dans votre ville ?</h2>
						<a href="#ancre3" class="info" title="Ici, vous pouvez saisir le nom de la ville dans laquelle vous recherchez une association ou un établissement."><?php echo img('info_off.png','Informations',21,21); ?></a>
					</div>
					<div id="ancre3">
						<!-- Début ville -->
						<fieldset class="champ">
							<legend>Sélectionner des associations dans votre ville</legend>
							<ul>
								<li>
									<label for="champ_ville">Nom de ville ou code postal</label>
									<input id="champ_ville" type="text" name="ville" placeholder="Nom de ville ou code postal" <?php if($this->input->post('ville')) echo 'value="'.$this->input->post('ville').'"'; ?> required />
								</li>
							</ul>
						</fieldset>
						<!-- Fin ville -->
						<p class="bouton"><input type="submit" value="Valider" /></p>
					</div>
				</form>
			</li>

      <!-- Département -->
			<li class="choix departement <?php if($this->input->post('departement') OR $this->input->post('departement_plus')) echo 'actif'; ?>">
				<div class="header">
					<h2>Dans votre département ?</h2>
					<a href="#ancre4" class="info" title="Ici, vous pouvez sélectionner un ou plusieurs départements et détailler le type d'établissement ou d'association recherché."><?php echo img('info_off.png','Informations',21,21); ?></a>
				</div>
				<div id="ancre4">
					<?php echo form_open(current_url()); ?>
						<!-- Début département -->
						<fieldset class="champ">
							<legend>Numéro du département</legend>
							<ul>
								<li>
									<label for="champ_departement">Numéro du département</label>
									<input id="champ_departement" type="text" name="departement" placeholder="Numéro ou nom du département" <?php if($this->input->post('departement')) echo 'value="'.$this->input->post('departement').'"'; ?> required />
								</li>
							</ul>
						</fieldset>
						<!-- Fin département -->
						<p class="bouton"><input type="submit" value="Valider" /></p>
					</form>
				</div>
			</li>

      <!-- Région -->
			<li class="choix region <?php if($this->input->post('region') OR $this->input->post('region_plus')) echo 'actif'; ?>">
				<div class="header">
					<h2>Dans votre région ?</h2>
					<a href="#ancre5" class="info" title="Ici, vous pouvez sélectionner une ou plusieurs régions et détailler le type d'établissement ou d'association recherché."><?php echo img('info_off.png','Informations',21,21); ?></a>
				</div>
				<div id="ancre5">
					<?php echo form_open(current_url()); ?>
						<!-- Début région -->
						<fieldset class="champ">
							<legend>Nom de la région</legend>
							<ul>
								<li>
									<label for="champ_region">Nom de la région</label>
									<input id="champ_region" type="text" name="region" placeholder="Nom de la région" <?php if($this->input->post('region')) echo 'value="'.$this->input->post('region').'"'; ?> required />
								</li>
							</ul>
						</fieldset>
						<!-- Fin région -->
						<p class="bouton"><input type="submit" value="Valider" /></p>
					</form>
				</div>
			</li>

      <!-- Mots-clés -->
			<li class="choix mot <?php if($this->input->post('mot')) echo 'actif'; ?>">
				<?php echo form_open(current_url()); ?>
					<div class="header">
						<h2>Par mots clés ?</h2>
						<a href="#ancre6" class="info" title="Ici, vous pouvez saisir une adresse, un nom d’association ou d’établissement, un numéro de téléphone, etc."><?php echo img('info_off.png','Informations',21,21); ?></a>
					</div>
					<div id="ancre6">
						<!-- Début mots clés -->
						<fieldset class="champ">
							<legend>Saisissez un mot clé</legend>
							<ul>
								<li>
									<label for="champ_mot">Mot clé</label>
									<input id="champ_mot" type="text" name="mot" placeholder="Mot clé" <?php if($this->input->post('mot')) echo 'value="'.$this->input->post('mot').'"'; ?> required />
								</li>
							</ul>
						</fieldset>
						<!-- Fin mots clés -->
						<p class="bouton"><input type="submit" value="Valider" /></p>
					</div>
				</form>
			</li>
		</ul>
	</div>

	<ul class="pied">
		<li><a href="<?php echo site_url('chiffres'); ?>" role="button" class="popincarte fancybox.iframe" >Afficher "l'Unapei en chiffres"</a></li>
		<li><a href="#permalien" role="button" class="permalien"><?php echo img('picto_reseau.png','Lien permanent',15,15); ?></a><code id="permalien">&#60;iframe src="<?php echo site_url(); ?>" scrolling="auto" id="unapei_cartographie" name="unapei_cartographie" vspace="0" hspace="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"&#62;&#60;/iframe&#62;</code></li>
	</ul>
</section>

<!-- Fin formulaire -->
<?php if($this->input->post()): ?>

<?php
	$recherche = '';
	foreach($this->input->post() as $key => $value)
	{
		if($key != 'localisation_etendu' AND $key != 'recherche_etendue') $recherche .= $value;
	}
?>

<!-- Début résultat -->
<section class="resultat">
	<header class="liste_header">
		<a href="#" class="plier"><?php echo img('bouton_plier.png','Plier',15,15); ?></a>
		<h1>Résultat de votre recherche : Associations et établissements ou services</h1>
		<p class="quantite">
			<em>
			<?php
				if($this->input->post())
				{
					if($recherche == '')
					{
						echo 'Vous devez renseigner les champs de saisie';
					}
					else
					{
						if($query AND $query->num_rows())
						{
							$activite = array(
								'A' => 'Artisanat',
								'B' => 'Environnement',
								'C' => 'Espaces verts',
								'D' => 'Industries graphiques',
								'E' => 'Informatique / bureautique',
								'F' => 'Logistique / conditionnement',
								'G' => 'Loisirs / événementiels',
								'H' => 'Nettoyage / entretien',
								'I' => 'Prestations industrielles',
								'J' => 'Produits de bouche',
								'K' => 'Prêt de main d\'œuvre'
							);

							//Vérifier l'utilisation unisue des numéros d'associations
							$filtre_asso = array();
							$filtre_asso_vu = array();
							foreach($query->result() as $row) {
								$filtre_asso[] = $row->assoNumero;
							}
							$filtre_asso_unique = array_unique($filtre_asso);

							//Vérifier les paramètres des établissements envoyés
							$filtre_etab = array();
							$filtre_etab_vu = array();
							$filtre_type_etab = array();
							$filtre_activite_etab = array();
							$filtre_age_etab = array();

							$ville = '';
							if($this->input->post('ville')) $ville = $this->input->post('ville');
							if($this->input->post('ville_etendu')) $ville = $this->input->post('ville_etendu');

							foreach($this->input->post() as $key => $value)
							{
								if(preg_match('/typeEtab/', $key)) $filtre_type_etab[] = str_replace('typeEtab_', '', $key);
								if(preg_match('/typeActivite/', $key)) $filtre_activite_etab[] = str_replace('typeActivite_', '', $key);
								if(preg_match('/typeAge/', $key)) $filtre_age_etab[] = str_replace('typeAge_', '', $key);
							}

							foreach($filtre_asso_unique as $value)
							{
								foreach($this->model_etendu->lire_etablissements_etendu($value, $ville, $filtre_type_etab, $filtre_activite_etab, $filtre_age_etab)->result() as $row)
								{
									$filtre_etab[] = $row->etabCodeUnapei;
								}
							}
							$filtre_etab_unique = array_unique($filtre_etab);

							if(count($filtre_asso_unique) > 1)
							{
								echo count($filtre_asso_unique).' associations trouvées';
							}
							else
							{
								echo count($filtre_asso_unique).' association trouvée';
							}
							if(count($filtre_etab_unique) > 0)
							{
								if(count($filtre_etab_unique) > 1)
								{
									echo ' - '.count($filtre_etab_unique).' établissements trouvés';
								}
								else
								{
									echo ' - '.count($filtre_etab_unique).' établissement trouvé';
								}
							}
							/*echo '<br/><br/>Type d\'association<br/>';
							print_r($typeAsso);
							echo '<br/>Type d\'établissement<br/>';
							print_r($typeEtab);
							echo '<br/>Type d\'activité<br/>';
							print_r($typeActivite);
							echo '<br/>Type d\'âge<br/>';
							print_r($typeAge);
							echo '<br/>Associations<br/>';
							print_r($filtre_asso_unique);
							echo '<br/>Etablissements<br/>';
							print_r($filtre_etab_unique);*/
						}
						else
						{
							echo 'Aucune réponse n\'a été trouvée';
							/*print_r($this->input->post('localisation'));
							echo '<br/><br/>Type d\'association<br/>';
							print_r($typeAsso);
							echo '<br/>Type d\'établissement<br/>';
							print_r($typeEtab);
							echo '<br/>Type d\'activité<br/>';
							print_r($typeActivite);
							echo '<br/>Type d\'âge<br/>';
							print_r($typeAge);*/
						}
					}
				}
			?>
			</em>
		</p>
	</header>

	<ul class="liste" itemscope="itemscope" itemtype="http://schema.org/Organization">
		<?php
			if($recherche == '')
			{
				echo '<li>&nbsp;</li>'."\n";
			}
			else
			{
				if($query AND $query->num_rows() > 0)
				{
					foreach($query->result() as $row)
					{
						if(!in_array($row->assoNumero, $filtre_asso_vu))
						{
							// Eviter les doublons
							$filtre_asso_vu[] = $row->assoNumero;

							$etablissements = $this->model_etendu->lire_etablissements_etendu($row->assoNumero, $ville, $filtre_type_etab, $filtre_activite_etab, $filtre_age_etab);

							$picto_etab = '';
							$picto_gps = img('picto_gps.png',$row->assoLng.','.$row->assoLat,20,20);
							$picto_association = img('picto_association.png');
							if($etablissements->num_rows() > 0)
							{
								$picto_etab = img('picto_etablissement.png',$etablissements->num_rows().' Établissements',20,20);
							}

							$assoNom = strtoupper($row->assoNom);
							$assoNomLength = strlen(trim($assoNom));
							$assoNomTitle = '';
							if($assoNomLength > 25 AND $assoNom != character_limiter($assoNom,25)) $assoNomTitle = ' data-name="'.$assoNom.'"';

							$assoType = $row->assoType;
							$assotype_nom = $this->model_asso->lire_assotype($assoType)->row('nom');
							$assotype_libelle = $this->model_asso->lire_assotype($assoType)->row('libelle');

							//Vérifier que le nom de l'association a bien été renseigné, sinon, l'exclure
							if(count($assotype_nom) > 0)
							{
								$associations = '<li class="liste_asso type_'.$assoType.' accordion">'."\n";
								$associations .= '<h2 itemprop="name" class="titre_asso"'.$assoNomTitle.'>'.character_limiter($assoNom,25).'<span><a href="#" role="button" title="'.$assotype_nom.'">'.$picto_association.'</a><a href="#" role="button" title="'.$etablissements->num_rows().' Établissements">'.$picto_etab.'</a>';
								$associations .= '<a href="javascript:window.close();" data-googlemaps="http://maps.google.com/maps?&z=10&q='.$row->assoLat.'+'.$row->assoLng.'&ll='.$row->assoLat.'+'.$row->assoLng.'" data-lat="'.$row->assoLat.'" data-lon="'.$row->assoLng.'" role="button" title="'.$row->assoLng.','.$row->assoLat.'" class="geo">'.$picto_gps.'</a></span></h2>'."\n";
								$associations .= '<div class="conteneur">'."\n";
								$associations .= '<div class="informations_asso">'."\n";
								$associations .= '<span itemprop="streetAddress">'.$row->assoAdresse;
								if(is_string($row->assoAdresseComplement) AND !empty($row->assoAdresseComplement))
								{
									if(!empty($row->assoAdresse)) $associations .= '<br/>';
									$associations .= $row->assoAdresseComplement;
								}
								if(is_string($row->assoAdresseVoie) AND !empty($row->assoAdresseVoie))
								{
									if(!empty($row->assoAdresse) AND !empty($row->assoAdresseComplement)) $associations .= '<br/>';
									$associations .= $row->assoAdresseVoie;
								}
								$associations .= '</span>';
								if(is_string($row->assoBP) AND !empty($row->assoBP))
								{
									if(!empty($row->assoAdresse) OR !empty($row->assoAdresseComplement) OR !empty($row->assoAdresseVoie)) $associations .= '<br/>';
									$associations .= '<span itemprop="postOfficeBoxNumber">'.$row->assoBP.'</span>';
								}
								if(!empty($row->assoAdresse) OR !empty($row->assoAdresseComplement) OR !empty($row->assoAdresseVoie) OR !empty($row->assoBP)) $associations .= '<br/>';
								$associations .= '<span itemprop="postalCode">'.$row->assoPrefixCP.$row->assoSuffixCP.'</span> <span itemprop="addressLocality">'. $row->assoVille.'</span>';
								if(is_string($row->assoPays) AND !empty($row->assoPays) AND $row->assoPays != 'France')
								{
									$associations .= '<br/><span itemprop="addressCountry">'.$row->assoPays.'</span>';
								}
								if(is_string($row->assoTelephone) AND !empty($row->assoTelephone))
								{
									$associations .= '<br/>Tél : <span itemprop="telephone">'.preg_replace('/[^0-9]/','',$row->assoTelephone).'</span>';
								}
								if(is_string($row->assoTelecopie) AND !empty($row->assoTelecopie))
								{
									$associations .= '<br/>Fax : <span itemprop="faxNumber">'.preg_replace('/[^0-9]/','',$row->assoTelecopie).'</span>';
								}
								if(is_string($row->assoCourriel) AND !empty($row->assoCourriel))
								{
									$associations .= '<br/>Courriel : <a href="mailto:'.$row->assoCourriel.'" title="Envoyer un courriel à '.$row->assoNom.'" itemprop="email">'.$row->assoCourriel.'</a>';
								}
								if(is_string($row->assoInternet) AND !empty($row->assoInternet))
								{
									$target_blank = $row->assoInternet;
									if(!preg_match('#http://#', $target_blank)) $target_blank = 'http://'.$target_blank;
									$associations .= '<br/>Internet : <a href="'.$target_blank.'" target="_blank" title="Voir le site Internet '.$row->assoNom.' (nouvelle fenêtre)" itemprop="url">'.$row->assoInternet.'</a>';
								}
								$associations .= "\n".'</div>'."\n";/* Fin .informations_asso */

								if($etablissements->num_rows() > 0)
								{
									$pluriel = '';
									$vide = '';
									$decompte = array();
									foreach($etablissements->result() as $row)
									{
										if(!in_array($row->etabCodeUnapei, $decompte))
										{
											$decompte[] = $row->etabCodeUnapei;
										}
										if(in_array($row->etabCodeUnapei, $filtre_etab_vu))
										{
											$vide = 'vide';
										}
									}
									if($vide == '')
									{
										if(count($decompte) > 1) $pluriel = 's';
										$associations .= '<div class="liste_etab">'."\n";
										$associations .= '<div class="etablissements"><strong>'.count($decompte).' Établissement'.$pluriel.'</strong></div>'."\n";
										$associations .= '<div class="conteneur accordion_3">'."\n";
										$associations .= '<ul itemscope="itemscope" itemtype="http://schema.org/Organization">'."\n";
									}

									// Si on a utilisé un filtre sur le type d'établissement, n'afficher que des types choisis
									// Si on a utilisé un filtre sur le type d'activité, n'afficher que des types choisis
									// Si on a utilisé un filtre sur les classes d'age, n'afficher que des types choisis

									foreach($etablissements->result() as $row)
									{
										// Eviter les doublons
										if(!in_array($row->etabCodeUnapei, $filtre_etab_vu))
										{
											$filtre_etab_vu[] = $row->etabCodeUnapei;

											$data_typeEtab = '';
											$data_typeActivite = '';
											$data_places = '';

											$tab_activites = array();
											$noms_activites = array();
											$liste_activites = '';

											$etablissements_activites = $this->model_etab->lire_etablissements_toutes_activites($row->etabCodeUnapei);
											if($etablissements_activites->num_rows() > 0)
											{
												foreach($etablissements_activites->result() as $value)
												{
													if(!in_array($value->etabActivite, $tab_activites))
													{
														$tab_activites[] = $value->etabActivite;
														$nom_activite = $this->model_etab->lire_nom_activite($value->etabActivite);
														foreach($nom_activite->result() as $value) $noms_activites[] = $value->libelle;
													}
												}
											}
											foreach($noms_activites as $value) $liste_activites .= '<li>'.$value.'</li>'."\n";

											$tab_places = array(
												'0 à 6 ans' => $row->etabPlaces0a6ans,
												'7 à 15 ans' => $row->etabPlaces7a15ans,
												'16 à 20 ans' => $row->etabPlaces16a20ans,
												'21 à 45 ans' => $row->etabPlaces21a45ans,
												'46 à 55 ans' => $row->etabPlaces46a55ans,
												'56 à 59 ans' => $row->etabPlaces56a59ans,
												'60 ans et plus' => $row->etabPlaces60ansPlus
											);
											$liste_places = '';

											foreach($tab_places as $age => $value)
											{
												if($value != '' AND $value != 0 AND $value != 'NULL') $liste_places .= '<li>'.$age.' : '.$value.'</li>'."\n";
											}

											$etabNom = strtoupper($row->etabNom);
											$etabNomLength = strlen(trim($etabNom));
											$etabNomTitle = '';
											if($etabNomLength > 25 AND $etabNom != character_limiter($etabNom,25)) $etabNomTitle = ' data-name="'.$etabNom.'"';

											$etabType = $row->etabType;
											$etabType_libelle = $this->model_etab->lire_etabType($etabType)->row('libelle');
											$etabType_description = $this->model_etab->lire_etabType($etabType)->row('description');

											$picto_gps = img('picto_gps.png',$row->etabLat.','.$row->etabLng,20,20);
											$associations .= '<li class="accordion_2">'."\n";
											$associations .= '<h2 itemprop="name" class="titre_etab"'.$etabNomTitle.'>'.character_limiter($etabNom,25).'<span><a href="#" role="button" title="'.$etabType_libelle.' : '.$etabType_description.'">'.$picto_association.'</a><a href="javascript:window.close();" data-googlemaps="http://maps.google.com/maps?&z=10&q='.$row->etabLat.'+'.$row->etabLng.'&ll='.$row->etabLat.'+'.$row->etabLng.'" data-lat="'.$row->etabLat.'" data-lon="'.$row->etabLng.'" role="button" title="'.$row->etabLat.','.$row->etabLng.'"  class="geo">'.$picto_gps.'</a></span></h2>'."\n";
											$associations .= '<div class="conteneur">'."\n";
											$associations .= '<div class="informations_etab">'."\n";
											$associations .= '<span itemprop="streetAddress">'.$row->etabAdresse;

											if(is_string($row->etabAdresseComplement) AND !empty($row->etabAdresseComplement))
											{
												if(!empty($row->etabAdresse)) $associations .= '<br/>';
												$associations .= $row->etabAdresseComplement;
											}
											if(is_string($row->etabAdresseVoie) AND !empty($row->etabAdresseVoie))
											{
												if(!empty($row->etabAdresse) OR !empty($row->etabAdresseComplement)) $associations .= '<br/>';
												$associations .= $row->etabAdresseVoie;
											}
											$associations .= '</span>';
											if(is_string($row->etabBP) AND !empty($row->etabBP))
											{
												if(!empty($row->etabAdresse) OR !empty($row->etabAdresseComplement) OR !empty($row->etabAdresseVoie)) $associations .= '<br/>';
												$associations .= '<span itemprop="postOfficeBoxNumber">'.$row->etabBP.'</span>';
											}
											if(!empty($row->etabAdresse) OR !empty($row->etabAdresseComplement) OR !empty($row->etabAdresseVoie) OR !empty($row->etabBP))
											{
											$associations .= '<br/>';
											}
											$associations .= '<span itemprop="postalCode">'.$row->etabPrefixCP.$row->etabSuffixCP.'</span> <span itemprop="addressLocality">'. $row->etabVille.'</span>';
											if(is_string($row->etabPays) AND !empty($row->etabPays) AND $row->etabPays != 'France')
											{
												$associations .= '<br/><span itemprop="addressCountry">'.$row->etabPays.'</span>';
											}
											if(is_string($row->etabTelephone) AND !empty($row->etabTelephone))
											{
												$associations .= '<br/>Tél : <span itemprop="telephone">'.preg_replace('/[^0-9]/','',$row->etabTelephone).'</span>';
											}
											if(is_string($row->etabTelecopie) AND !empty($row->etabTelecopie))
											{
												$associations .= '<br/>Fax : <span itemprop="faxNumber">'.preg_replace('/[^0-9]/','',$row->etabTelecopie).'</span>';
											}
											if(is_string($row->etabCourriel) AND !empty($row->etabCourriel))
											{
												$associations .= '<br/>Courriel : <a href="mailto:'.$row->etabCourriel.'" title="Envoyer un courriel à '.$row->etabNom.'" itemprop="email">'.$row->etabCourriel.'</a>';
											}
											if(is_string($row->etabInternet) AND !empty($row->etabInternet))
											{
												$target_blank = $row->etabInternet;
												if(!preg_match('#http://#', $target_blank)) $target_blank = 'http://'.$target_blank;
												$associations .= '<br/>Internet : <a href="'.$target_blank.'" target="_blank" title="Voir le site Internet '.$row->etabNom.' (nouvelle fenêtre)" itemprop="url">'.$row->etabInternet.'</a>'."\n";
											}

											if($liste_activites != '' OR $liste_places != '') $associations .= '<div class="complement">'."\n";
											if($liste_activites != '')
											{
												$associations .= '<h3 class="activite">Activités</h3>'."\n";
												$associations .= '<ul>'.$liste_activites.'</ul>'."\n";
											}
											if($liste_places != '')
											{
												$associations .= '<h3 class="activite">Nombre de places</h3>'."\n";
												$associations .= '<ul>'.$liste_places.'</ul>'."\n";
											}
											if($liste_activites != '' OR $liste_places != '') $associations .= '</div>'."\n";;

											$associations .= '</div>'."\n";/* Fin .conteneur */
											$associations .= '</div>'."\n";/* Fin .informations_etab */
											$associations .= '</li>'."\n";/* Fin .accordion_2 */
										}
									}
									if($vide == '')
									{
										$associations .= '</ul>'."\n";
										$associations .= '</div>'."\n";/* Fin .accordion_3 */
										$associations .= '</div>'."\n";/* Fin .liste_etab */
									}
								}
								$associations .= '</div>'."\n";/* Fin .conteneur */
								$associations .= '</li>'."\n";/* Fin .liste_asso */
								echo $associations;
							}
						}
					}
				}
				else
				{
					echo '<li>&nbsp;</li>'."\n";
				}
			}
		?>
	</ul>
</section>
<?php endif; ?>
