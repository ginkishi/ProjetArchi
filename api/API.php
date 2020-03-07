<?php
include("pdo.php");
class API
{
	private static $bdd = null;

	private function __construct()
	{
	}


	private static function checkBDD()
	{
		if (self::$bdd == null) {
			self::$bdd = BDD::getInstance();
		}
	}

	private static function cleanUserInput($input)
	{
		$input = htmlentities($input);
		return $input;
	}

	public static function getIdentification($user, $mp)
	{
		self::checkBDD();
		$user = self::cleanUserInput($user);
		$mp = self::cleanUserInput($mp);
		$query = self::$bdd->query("select P_ID,P_CODE,P_NOM, P_PRENOM , P_GRADE from `pompier` where P_CODE='" . $user . "' and P_MDP='" . $mp . "';");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getAllVehicules()
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT V_ID,V_INDICATIF,V_MODELE,V_IMMATRICULATION,V_KM,ROLE_NAME FROM `vehicule` v INNER JOIN type_vehicule_role tvr on tvr.TV_CODE = v.TV_CODE;");
		$query = self::$bdd->query("SELECT V_ID ID,V_INDICATIF Nom,V_MODELE Modele,V_IMMATRICULATION Immatriculation,V_ANNEE Annee,V_KM Kilometrage,VP_LIBELLE Statut,TV_LIBELLE Type FROM vehicule v JOIN vehicule_position vp on v.VP_ID = vp.VP_ID JOIN type_vehicule tv on tv.TV_CODE = v.TV_CODE");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getAllVehiculesId()
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT V_INDICATIF, V_ID FROM `vehicule`;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getVehiculeById($id)
	{
		self::checkBDD();
		$id = self::cleanUserInput($id);
		$query = self::$bdd->query("SELECT V_ID,V_INDICATIF,V_MODELE,V_IMMATRICULATION,V_KM,ROLE_NAME,ROLE_ID FROM `vehicule` v INNER JOIN type_vehicule_role tvr on tvr.TV_CODE = v.TV_CODE WHERE v.V_ID = " . $id . " ;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getAllUsersId()
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT P_NOM, P_PRENOM ,P_CODE FROM `pompier`;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function getCodeTypeIntervention($description)
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT TI_CODE FROM `type_intervention` WHERE TI_DESCRIPTION='$description';");
		$row = $query->fetch();
		return $row['TI_CODE'];
	}

	public static function getPompierID($prenom, $nom)
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT P_ID FROM `pompier` WHERE P_NOM='$nom' AND P_PRENOM='$prenom';");
		$row = $query->fetch();
		return $row['P_ID'];
	}

	public static function getTypeInterventionList()
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT TI_DESCRIPTION, TI_CODE FROM `type_intervention`;");
		return	$query;
	}

	public static function getAllVehiculesIndicatif()
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT V_ID, V_INDICATIF FROM `vehicule`;");
		return $query;
	}

	public static function getTeam($indicatif)
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT ROLE_NAME  FROM `type_vehicule_role` tvr INNER JOIN vehicule v WHERE v. V_INDICATIF='$indicatif' and tvr.TV_CODE = v.TV_CODE;");
		return $query;
	}

	public static function getNBvehicule()
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT COUNT(*) as nb FROM vehicule;");
		$data = $query->fetch();
		$nb = $data['nb'];
		return $nb;
	}

	public static function getIDRole($name, $code)
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT ROLE_ID  FROM `type_vehicule_role`  WHERE ROLE_NAME='$name' AND TV_CODE='$code'; ");
		$row = $query->fetch();
		return $row['ROLE_ID'];
	}

	public static function getVehiculeTV_CODE($id)
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT TV_CODE  FROM `vehicule`  WHERE V_ID=$id;");
		$row = $query->fetch();
		return $row['TV_CODE'];
	}



	public static function getPompierById($id)
	{
		self::checkBDD();
		$id = self::cleanUserInput($id);
		$query = self::$bdd->query("SELECT P_PRENOM, P_NOM  FROM `pompier`  WHERE P_ID=$id;");
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}