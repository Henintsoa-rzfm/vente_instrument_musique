<?php  
	namespace Controllers;

	require_once "libraries/Autoloader.php" ;
	
	class ModeleI  extends Controller implements iController 
	{
		//...................................

		public static function insert(array $post): void 
		{
			\Models\ModeleI::insert($post);
			$code = \Models\ModeleI::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.modeles#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\ModeleI::connecter();
			\Models\ModeleI::deleteByID($id);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.modeles'>";
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\ModeleI::connecter();
			\Models\ModeleI::staticUpdate($post);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.modeles'>";
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\ModeleI::connecter();
			$tableauArticle = \Models\ModeleI::find($post);
			return $tableauArticle ;
		}
		public static function index($param): void 
		{
			
		}
		//...................................

		public static function render($args): void 
		{

		}		//...................................
	}



?>