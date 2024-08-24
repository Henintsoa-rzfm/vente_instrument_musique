<?php 
	function charger_classe($nom_classe){
		$nom_classe = str_replace("\\","/",$nom_classe);
		require_once($nom_classe . ".php");
	}

	spl_autoload_register("charger_classe");
?>