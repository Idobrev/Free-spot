<?php 
class Controller {
	
	protected $view;
	protected $model;

	protected function __construct(){
		//var_dump('Main Controller');
		$this->view = new View();
		$this->callModel(get_class($this));
	}
	
	private function callModel($model){
		require(MODELS . $model . '_model.php');
		$model = $model . '_model';
		$this->model = new $model;
	}
}
?>