<?php

	$listetab .= '<li class="type_'.$code.' accordion_2">'."\n";
	$listetab .= '<h2 itemprop="name" class="titre_etab">'.$row->etabNom.'<span><a href="#" role="button" title="'.$row->etabLng.','.$row->etabLat.'">'.img('picto_gps.png',$row->etabLng.','.$row->etabLat,20,20).'</a></span></h2>'."\n";
	$listetab .= '<div class="conteneur">'."\n";
	$listetab .= '<div class="informations_etab">'."\n";
	$listetab .= '<span itemprop="streetAddress">'.$row->etabAdresse;

	if(is_string($row->etabAdresseComplement) AND !empty($row->etabAdresseComplement))
	{
		if(!empty($row->etabAdresse)) $listetab .= '<br/>';
		$listetab .= $row->etabAdresseComplement;
	}
	if(is_string($row->etabAdresseVoie) AND !empty($row->etabAdresseVoie))
	{
		if(!empty($row->etabAdresse) OR !empty($row->etabAdresseComplement)) $listetab .= '<br/>';
		$listetab .= $row->etabAdresseVoie;
	}
	$listetab .= '</span>';
	if(is_string($row->etabBP) AND !empty($row->etabBP))
	{
		if(!empty($row->etabAdresse) OR !empty($row->etabAdresseComplement) OR !empty($row->etabAdresseVoie)) $listetab .= '<br/>';
		$listetab .= '<span itemprop="postOfficeBoxNumber">'.$row->etabBP.'</span>';
	}
	if(!empty($row->etabAdresse) OR !empty($row->etabAdresseComplement) OR !empty($row->etabAdresseVoie) OR !empty($row->etabBP))
	{
	$listetab .= '</br>';
	}
	$listetab .= '<span itemprop="postalCode">'.$row->etabPrefixCP.$row->etabSuffixCP.'</span> <span itemprop="addressLocality">'. $row->etabVille.'</span>';
	if(is_string($row->etabPays) AND !empty($row->etabPays) AND $row->etabPays != 'France')
	{
		$listetab .= '<br/><span itemprop="addressCountry">'.$row->etabPays.'</span>';
	}
	if(is_string($row->etabTelephone) AND !empty($row->etabTelephone))
	{
		$listetab .= '<br/>Tél : <span itemprop="telephone">'.preg_replace('/[^0-9]/','',$row->etabTelephone).'</span>';
	}
	if(is_string($row->etabTelecopie) AND !empty($row->etabTelecopie))
	{
		$listetab .= '<br/>Fax : <span itemprop="faxNumber">'.preg_replace('/[^0-9]/','',$row->etabTelecopie).'</span>';
	}
	if(is_string($row->etabCourriel) AND !empty($row->etabCourriel))
	{
		$listetab .= '<br/>Courriel : <a href="mailto:'.$row->etabCourriel.'" title="Envoyer un courriel à '.$row->etabNom.'" itemprop="email">'.$row->etabCourriel.'</a>';
	}
	if(is_string($row->etabInternet) AND !empty($row->etabInternet))
	{
		$listetab .= '<br/>Internet : <a href="'.$row->etabInternet.'" target="_blank" title="Voir le site Internet '.$row->etabNom.' (nouvelle fenêtre)" itemprop="url">'.$row->etabInternet.'</a>';
	}

	$listetab .= "\n".'</div>'."\n";/* Fin Informations Etab */
	$listetab .= '</div>'."\n";/* Fin Conteneur */
	$listetab .= '</li>'."\n";/* Fin Accordion 2 */

?>
