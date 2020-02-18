<?php
require_once(VIEWS . DS . "view.php");
require_once(MODELS . DS . "loginM.php");
require_once("./controllers/homeC.php");
require_once("./controllers/sessionHandler.php");

class LoginController
{
	public function __construct()
	{
	}


	public function index()
	{
		// Check if PHP session is started (start it if not already started)
		GestionnaireSession::ouvreSession();

		// Si deja connecter -> redirection vers la home page
		$v = new View();
		if (GestionnaireSession::is_set()) {
			$v->afficher("home_index");
		} else {
			$v->afficherLogin();
		}
	}


	public function authenticate()
	{
		GestionnaireSession::ouvreSession();

		$modele = new LoginModel();
		$record = $modele->connect($_POST["username"], $_POST["password"]);

		if (sizeof($record) == 1) {
			//var_dump($record[0]);
			GestionnaireSession::initializeSession(
				$record[0]['P_ID'],
				$record[0]['P_CODE'],
				$record[0]['P_NOM'],
				$record[0]['P_PRENOM'],
				$record[0]['P_GRADE']
			);
			/**$_SESSION["id"] = $record[0]['P_ID'];
				$_SESSION["code"] = $record[0]['P_CODE'];
				$_SESSION["nom"] = $record[0]['P_NOM'];
				$_SESSION["prenom"] = $record[0]['P_PRENOM'];
				$_SESSION["grade"] = $record[0]['P_GRADE'];*/

			$v = new View();
			$v->afficher("home_index");
		} else {
			$v = new View();
			$v->ajouterVariable("error_message", "Impossible de se connecter!");
			$v->afficherLogin();
		}
	}

	public function disconnect()
	{
		GestionnaireSession::ouvreSession();

		$v = new View();
		if (GestionnaireSession::is_set()) {
			$v->ajouterVariable("sucess_message", "Vous avez bien été déconnecté!");
			GestionnaireSession::un_set();
		}
		GestionnaireSession::detruire();
		$v->afficherLogin();
	}
}