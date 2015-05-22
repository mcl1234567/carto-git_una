<?php

if($this->input->get())
{
	$recherche = '';
	foreach($this->input->get() as $key => $value)
	{
		if($key != 'localisation_etendu' AND $key != 'recherche_etendue') $recherche .= $value;
	}
}

if($query AND $recherche != '')
{
	header("Content-type: text/xml");
	echo '<markers>';

	$filtre_asso = array();
	$filtre_asso_vu = array();
	foreach($query->result() as $row) $filtre_asso[] = $row->assoNumero;
	$filtre_asso_unique = array_unique($filtre_asso);

	$filtre_etab = array();
	$filtre_etab_vu = array();
	$filtre_type_etab = array();
	$filtre_activite_etab = array();
	$filtre_age_etab = array();

	$ville = '';
	if($this->input->get('ville')) $ville = $this->input->get('ville');
	if($this->input->get('ville_etendu')) $ville = $this->input->get('ville_etendu');

	foreach($this->input->get() as $key => $value)
	{
		if(preg_match('/typeEtab/', $key)) $filtre_type_etab[] = str_replace('typeEtab_', '', $key);
		if(preg_match('/typeActivite/', $key)) $filtre_activite_etab[] = str_replace('typeActivite_', '', $key);
		if(preg_match('/typeAge/', $key)) $filtre_age_etab[] = str_replace('typeAge_', '', $key);
	}

	foreach($query->result() as $row)
	{
		if(!in_array($row->assoNumero, $filtre_asso_vu))
		{
			$filtre_asso_vu[] = $row->assoNumero;
			$etablissements = $this->model_etendu->lire_etablissements_etendu($row->assoNumero, $ville, $filtre_type_etab, $filtre_activite_etab, $filtre_age_etab);
			$target_blank = $row->assoInternet;
			if($target_blank != '' AND !preg_match('#http://#', $target_blank)) $target_blank = 'http://'.$target_blank;

			echo '<marker ';
			echo 'name="'.xml_convert($row->assoNom).'" ';
			echo 'adresseVoie="'.xml_convert($row->assoAdresseVoie).'" ';
			echo 'adresse="'.xml_convert($row->assoAdresse).'" ';
			echo 'BP="'.xml_convert($row->assoBP).'" ';
			echo 'adresseComplement="'.xml_convert($row->assoAdresseComplement).'" ';
			echo 'ville="'.xml_convert($row->assoVille).'" ';
			echo 'CP="'.xml_convert($row->assoPrefixCP.$row->assoSuffixCP).'" ';
			echo 'telephone="'.xml_convert(preg_replace('/[^0-9]/','',$row->assoTelephone)).'" ';
			echo 'telecopie="'.xml_convert(preg_replace('/[^0-9]/','',$row->assoTelecopie)).'" ';
			echo 'courriel="'.xml_convert($row->assoCourriel).'" ';
			echo 'internet="'.xml_convert($target_blank).'" ';
			echo 'lat="'.$row->assoLat.'" ';
			echo 'lng="'.$row->assoLng.'" ';
			echo 'type="association" ';
			echo '/>';

			if ($etablissements->num_rows() > 0)
			{
				foreach($etablissements->result() as $row)
				{
					if(!in_array($row->etabCodeUnapei, $filtre_etab_vu))
					{
						$filtre_etab_vu[] = $row->etabCodeUnapei;
						$target_blank = $row->etabInternet;
						if($target_blank != '' AND !preg_match('#http://#', $target_blank)) $target_blank = 'http://'.$target_blank;

						echo '<marker ';
						echo 'name="'.xml_convert($row->etabNom).'" ';
						echo 'adresseVoie="'.xml_convert($row->etabAdresseVoie).'" ';
						echo 'adresse="'.xml_convert($row->etabAdresse).'" ';
						echo 'BP="'.xml_convert($row->etabBP).'" ';
						echo 'adresseComplement="'.xml_convert($row->etabAdresseComplement).'" ';
						echo 'CP="'.xml_convert($row->etabPrefixCP.$row->etabSuffixCP).'" ';
						echo 'ville="'.xml_convert($row->etabVille).'" ';
						echo 'telephone="'.xml_convert(preg_replace('/[^0-9]/','',$row->etabTelephone)).'" ';
						echo 'telecopie="'.xml_convert(preg_replace('/[^0-9]/','',$row->etabTelecopie)).'" ';
						echo 'courriel="'.xml_convert($row->etabCourriel).'" ';
						echo 'internet="'.xml_convert($target_blank).'" ';
						echo 'lat="'.$row->etabLat.'" ';
						echo 'lng="'.$row->etabLng.'" ';
						echo 'type="etablissement" ';
						echo '/>';
					}
				}
			}
		}
	}
	echo '</markers>';
}

?>
