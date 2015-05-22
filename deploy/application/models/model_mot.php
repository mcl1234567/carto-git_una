<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mot extends CI_Model {

	function lire_mot($mot)
	{
		// Si le mot correspond à un type d'association, rechercher aussi une correspondance de type
		$type = array();
		if(preg_match('/[uU][rR][aA][pP][eE][iI]/', $mot)) $type[] = '099';
		if(preg_match('/[uU][dD][aA][pP][eE][iI]/', $mot)) $type[] = '098';
		if(preg_match('/[aA][dD][aA][pP][eE][iI]/', $mot)) $type[] = '1';
		if(preg_match('/[aA]ssociation correspondante locale/', $mot)) $type[] = '2';
		if(preg_match('/[aA]ssociation correspondante nationale/', $mot)) $type[] = '7';
		if(preg_match('/[aA]ssociation tutélaire/', $mot)) $type[] = '5';
		if(preg_match('/[aA]ssociation locale/', $mot))
		{
			$type[] = '3';
			$type[] = '4';
			$type[] = '6';
			$type[] = '8';
			$type[] = '9';
		}

		// Si le mot correspond à un type d'activité, rechercher uniquement les établisements proposant cette activité
		$activiteEtab = '';
		$activite = array(
			'A' => '/[aA]rtisanat/',
			'B' => '/[eE]nvironnement/',
			'C' => '/[eE]spaces verts/',
			'D' => '/[iI]ndustries graphiques/',
			'E' => '/[iI]nformatique|[bB]ureautique/',
			'F' => '/[lL]ogistique|[cC]onditionnement/',
			'G' => '/[lL]oisirs|[éeÉE]vénementiel/',
			'H' => '/[nN]ettoyage|[eE]ntretien/',
			'I' => '/[pP]restations|[iI]ndustriel/',
			'J' => '/[pP]roduits|[bB]ouche/',
			'K' => '/[pP]rêt|[mM]ain|œuvre|[oO]euvre/',
			'A10' => '/Travail du cuir/',
			'A110' => '/Fabrication de produits cosmétiques/',
			'A120' => '/Encadrement/',
			'A130' => '/Fabrication de jouets/',
			'A140' => '/Salon de coiffure/',
			'A20' => '/Travail du bois/',
			'A30' => '/Artisanat d\'art/',
			'A40' => '/Fabrication de souvenirs/',
			'A50' => '/Confection d\'objets décoratifs/',
			'A60' => '/Confection|restauration de meubles/',
			'A70' => '/Confection de vêtement/',
			'A80' => '/Création de sac/',
			'A90' => '/Activité textile/',
			'B10' => '/Collecte et tri de déchets/',
			'B20' => '/Traitement de déchets/',
			'B30' => '/DEEE/',
			'C10' => '/Entretien d\'espace vert/',
			'C20' => '/[dD]écoration|florale|floral/',
			'C30' => '/Horticulture|Pépinière/',
			'C40' => '/Sylviculture/',
			'C50' => '/Découpage de bois à chauffer/',
			'C60' => '/Serres/',
			'D10' => '/PAO/',
			'D20' => '/Façonnage|Brochage/',
			'D30' => '/Reprographie/',
			'D40' => '/Imprimerie/',
			'D50' => '/Sérigraphie/',
			'D60' => '/Tampographie/',
			'E10' => '/Archivage/',
			'E20' => '/GED|Gestion Electronique des Documents/',
			'E30' => '/Copie de CD-DVD/',
			'E40' => '/Mailing/',
			'E50' => '/Saisie informatique/',
			'E60' => '/Fournitures de bureau/',
			'E70' => '/Travaux administratifs/',
			'E80' => '/Papeterie/',
			'F10' => '/Conditionnement divers/',
			'F20' => '/Conditionnement alimentaire/',
			'F30' => '/Mise sous pli/',
			'F40' => '/Contrôle qualité/',
			'F50' => '/Assemblage|Montage/',
			'F60' => '/Stockage|Magasinage/',
			'F70' => '/Expédition|Routage/',
			'F80' => '/Cartonnage/',
			'F90' => '/Echantillonnage/',
			'G10' => '/Location de salle/',
			'G20' => '/Traiteur/',
			'G30' => '/Restauration/',
			'G40' => '/Plateau-repas/',
			'G50' => '/Spectacles|Théâtre|Musique/',
			'G60' => '/Hébergement/',
			'G70' => '/Centre équestre/',
			'G80' => '/Livraison de nourriture à domicile/',
			'G90' => '/Expositions/',
			'H10' => '/Blanchisserie/',
			'H100' => '/Réparation/',
			'H110' => '/Voierie/',
			'H120' => '/Nettoyage industriel/',
			'H130' => '/Déménagement/',
			'H20' => '/Repasserie/',
			'H30' => '/Retouche|Couture/',
			'H40' => '/Entretien des locaux/',
			'H50' => '/Entretien des espaces urbains|parking|rue/',
			'H60' => '/Travaux d\'entretien à domicile/',
			'H70' => '/Lavage de voitures/',
			'H80' => '/Travaux bâtiment|peinture|maçonnerie/',
			'H90' => '/Fourniture de produits d\'entretien/',
			'I10' => '/Electronique|Electromécanique/',
			'I20' => '/Montage électrique|Câblage/',
			'I30' => '/Travail des métaux/',
			'I40' => '/Plasturgie/',
			'I50' => '/Perçage/',
			'I60' => '/Serrurerie/',
			'I70' => '/Découpe/',
			'I80' => '/Verrerie/',
			'J10' => '/Vins|Bières|Spiritueux/',
			'J20' => '/Fruits et légumes/',
			'J30' => '/Elevage/',
			'J40' => '/Produits gastronomiques/',
			'J50' => '/Viticulture/',
			'J60' => '/Produits biologiques/',
			'J70' => '/Ostréiculture/',
			'K10' => '/Mise à disposition de personne/'
		);
		foreach($activite as $key=>$value)
		{
			if(preg_match($value, $mot)) $activiteEtab = $key;
		}

		// Si le mot correspond à un type d'établissement, rechercher uniquement ces établisements
		$typeEtabVu = array();
		$tblEtabType = array(
			'101' => '/[cC][aA][mM][sS][pP]/',
			'102' => '/jardins|enfants|haltes garderies/',
			'103' => '/[iI][eE][mM]/',
			'104' => '/[iI][tT][eE][pP]/',
			'201' => '/[iI][mM][eE]|[iI][mM][pP]|[iI][mM][pP][rR][oO]/',
			'205' => '/[cC][iI]|[cC][sS]|[cC][lL][iI][sS]/',
			'207' => '/[cC][mM][pP][pP]/',
			'208' => '/[hH][oô]pital de jour/',
			'404' => '/[sS][eE][sS][sS][aA][dD]|[sS][sS][eE][sS][dD]|service [ée]ducatif/',
			'206' => '/formation|alternance/',
			'301' => '/[eE][sS][aA][tT]/',
			'302' => '/foyer|h[ée]bergement/',
			'304' => '/entreprises|adapt[ée]es|ateliers prot[ée]g[ée]s/',
			'305' => '/appartements autonomes|sans accompagnement/',
			'306' => '/structure|h[ée]bergement autonome|agr[ée]ment/',
			'307' => '/[sS][aA][vV][sS]/',
			'308' => '/[eE][pP]SR/',
			'309' => '/personnes handicap[ée]es|vieillissantes|ag[ée]es/',
			'310' => '/[sS][iI][sS][eE][pP]/',
			'311' => '/accueil temporaire/',
			'312' => '/[sS]ACAT|[sS][aA][tT][rR][aA]/',
			'313' => '/structure exp[ée]rimentale/',
			'401' => '/[mM][aA][sS]/',
			'402' => '/[fF][aA][mM]/',
			'403' => '/structure|h[ée]bergement|foyer de vie|activit[ée]s de jour|foyer occupationnel/',
			'406' => '/[sS][aA][mM][sS][aA][hH]/',
			'407' => '/[sS][sS][iI][aA][dD]/',
			'408' => '/structure|sans h[ée]bergement|foyer de vie|activit[ée]s de jour|foyer occupationnel/',
			'409' => '/service|accueillants familiaux/',
			'600' => '/divers|autres services/',
			'601' => '/services administratifs/',
			'607' => '/[sS][aA][aA][dD]|maintien [àa] domicile/',
			'612' => '/[cC][pP][fF][sS]/',
			'613' => '/centre de loisirs|ludoth[èe]que/',
			'614' => '/centre de vacances/',
			'616' => '/[cC][fF][aA][sS]/',
			'666' => '/service tut[ée]laire/'
		);
		foreach($tblEtabType as $key => $value)
		{
			if(preg_match($value, $mot)) $typeEtabVu[] = $key;
		}


		$this->db->select('*');
		$this->db->from('tblAsso');
		$this->db->join('tblAssoType', 'tblAssoType.code = tblAsso.assoType', 'left');
		if($activiteEtab != '' OR count($typeEtabVu) > 0)
		{
			$this->db->join('tblEtab','tblAsso.assoNumero = tblEtab.assoNumero','left');
			if($activiteEtab != '') $this->db->join('tblEtabActivites','tblEtabActivites.etabCodeUnapei = tblEtab.etabCodeUnapei','left');
			$this->db->like('tblEtab.etabNom',$mot);
			if($activiteEtab != '') $this->db->or_like('tblEtabActivites.etabActivite',$activiteEtab,'after');
			$this->db->where('tblEtab.etabRetrait !=', 1)
				->where('tblEtab.etabLat !=', 0)
				->where('tblEtab.etabLng !=', 0);
		}
		else
		{
			if(count($type) > 0)
			{
				$this->db->where_in('tblAsso.assoType', $type);
			}
			else
			{
				$this->db->join('tblEtab','tblAsso.assoNumero = tblEtab.assoNumero','left');
				$this->db->like('tblAsso.assoNom',$mot);
				$this->db->or_like('tblEtab.etabNom',$mot);
				$this->db->or_like('tblAsso.assoAdresseVoie',$mot);
				$this->db->or_like('tblAsso.assoAdresse',$mot);
				$this->db->or_like('tblAsso.assoAdresseComplement',$mot);
				$this->db->or_like('tblAsso.assoVille',$mot);
			}
		}
		$this->db->where('tblAsso.assoRetrait !=', 1);
		$this->db->order_by('tblAssoType.num_ordre', 'asc');
		$this->db->order_by('tblAsso.assoNom', 'asc');
		$query = $this->db->get();
		return $query;
	}
}

/* End of file model_mot.php */
/* Location: ./application/models/model_mot.php */

?>
