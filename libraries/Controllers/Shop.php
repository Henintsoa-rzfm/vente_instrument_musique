<?php  
	namespace Controllers;

	require_once "libraries/Models/Shop.php" ;
	
	class Shop  extends Controller implements iController 
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
			\Models\Shop::insert($post);
			$code = \Models\Shop::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\Shop::connecter();
			\Models\Shop::deleteByID($id);
			header("Location: ?page=page");
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\Shop::connecter();
			\Models\Shop::staticUpdate($post);
			header("Location: ?page=page");
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\Shop::connecter();
			$tableauArticle = \Models\Shop::find($post);
			return $tableauArticle ;
		}
		//...................................
	}



?>