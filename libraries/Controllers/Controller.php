<?php  
	namespace Controllers ;

	class Controller
	{
		public static function index(array $get)
		{
			$listePages = scandir("Views/");

			if (isset($get["page"])) {
				if(in_array($get["page"] . ".php", $listePages))
				{
					include "Views/".$get["page"].".php";
				}else{
					echo "Page introuvable!";
				}
			}else{
					include "Views/liste.clients.php";		
			}
		}
	}
?>