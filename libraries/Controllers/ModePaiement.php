<?php  
	namespace Controllers;

	require_once "libraries/Models/ModePaiement.php" ;
	
	class ModePaiement  extends Controller implements iController 
	{
		
		public static function index($param): void 
		{
			
		}
		//...................................

		public static function render($args): void 
		{

		}
		//...................................

		public static function insert(array $post): void 
		{
			\Models\ModePaiement::insert($post);
			$code = \Models\ModePaiement::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\ModePaiement::connecter();
			\Models\ModePaiement::deleteByID($id);
			header("Location: ?page=page");
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\ModePaiement::connecter();
			\Models\ModePaiement::staticUpdate($post);
			header("Location: ?page=page");
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\ModePaiement::connecter();
			$tableauArticle = \Models\ModePaiement::find($post);
			return $tableauArticle ;
		}
		//...................................
	}



?>