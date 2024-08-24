<?php  
	namespace Controllers;

	require_once "libraries/Models/Province.php" ;
	
	class Province  extends Controller implements iController 
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
			\Models\Province::insert($post);
			$code = \Models\Province::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\Province::connecter();
			\Models\Province::deleteByID($id);
			header("Location: ?page=page");
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\Province::connecter();
			\Models\Province::staticUpdate($post);
			header("Location: ?page=page");
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\Province::connecter();
			$tableau = \Models\Province::find($post);
			return $tableau ;
		}
		//...................................
	}



?>