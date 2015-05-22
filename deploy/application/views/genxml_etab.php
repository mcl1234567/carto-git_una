<?php

if($query) {
	header("Content-type: text/xml");

	echo '<markers>';
	foreach($query->result() as $row)
	{
		$etablissements = $this->model_etab->lire_etablissements($row->assoNumero);

		if ($etablissements->num_rows() > 0)
		{
			foreach($etablissements->result() as $row)
			{
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
				echo 'internet="'.xml_convert($row->etabInternet).'" ';
				echo 'lat="'.$row->etabLat.'" ';
				echo 'lng="'.$row->etabLng.'" ';
				echo 'type="etablissement" ';
				echo '/>';
			}
		}
	}
	echo '</markers>';
}

?>
