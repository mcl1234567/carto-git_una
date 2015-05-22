<?php

if($query)
{
	header("Content-type: text/xml");

	echo '<markers>';
	foreach($query->result() as $row)
	{
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
		echo 'internet="'.xml_convert($row->assoInternet).'" ';
		echo 'lat="'.$row->assoLat.'" ';
		echo 'lng="'.$row->assoLng.'" ';
		echo 'type="association" ';
		echo '/>';
	}
	echo '</markers>';
}

?>
