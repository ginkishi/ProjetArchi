<?php
	require_once(VIEWS.DS."view.php");
	
	class HomeController
	{
		public function __construct()
		{
		}
		
		public function index()
		{
			$v = new View();
			$v->afficher("home_index");
		}
	}
?>