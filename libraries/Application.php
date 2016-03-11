<?php
class Application {

	public $url;
	/**
	 * Starts the session
	 */
	public function startSession() {
		if (!isset($_SESSION)){
			Session::init();
		}
	}
	/**
	 * Simple parsing of URL
	 */
	public function parseURL() {
		if (!isset($_GET['url'])){header('Location: index');}
		$url = $_GET['url'];
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$this->url = new stdClass();
		$this->url->controllerName = $url[0];
		@$this->url->method = $url[1];
	}
	/**
	 * Invokes configurator to parse the configuration or throws an error
	 */
	public function readConfiguration() {
		try {
			Configurator::parseConfiguration();	
		} catch (MegatronException $e){
			echo $e->errorMessage();
			exit;
		}
	}
	
	/**
	 * Validates url and calls the controller 
	 */
	public function callController() {
		$controllerName = $this->url->controllerName; // contains our controller main
		$method = $this->url->method; //the method we are going to invoke from our controller
		$args = ''; //arguments to be passed to our invoked method 
		try {
			if ( Configurator::getField('Megatron', 'absorb-mode') == TRUE ) { //checks if we are in absorb mode. In this mode Megatron will only invoke the absorb controller. 
				$controllerName = 'absorb';
				$method = '';
				$args = $this->url->controllerName;
			} else if (Configurator::getField('Megatron', 'is-installed') == TRUE) { //check to see whether we need to install Megatron first
				
			}
			// actually call the controllers 
			if (file_exists(CONTROLLERS . $controllerName . '.php')) {
				require(CONTROLLERS . $controllerName . '.php');
	        	$controller = new $controllerName;
				#$controller = new ReflectionClass($controllerName);
				if (!empty($this->url->method)) {
					$this->callMethod($controller, $method, $args);
				}else {
					$this->callMethod($controller, 'index', $args);
				}
			}else {
				$this->callErrorController();
			}
		} catch (MegatronException $e) {
			echo $e->errorMessage();
			exit;
		}
	}
	/**
	 * Calls the method of the current controller
	 */
	private function callMethod($controller, $method, $args) {
		try {
			if (method_exists($controller, $method)){
				$controller->{$method}($args);
			}else {
				$this->callErrorController();
			}
		} catch (MegatronException $e){
			echo $e->errorMessage();
			exit;
		}
	}
	/**
	 * Calls the error controller by default
	 */
	private function callErrorController() {
		require(CONTROLLERS . 'error.php');
		$err = new Error();
		$err->err_undefinedURL();
		return false;
	}
}
?>