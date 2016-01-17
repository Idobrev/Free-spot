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
	 * Validates url and calls the controller 
	 */
	public function callController() {
		if (file_exists(CONTROLLERS . $this->url->controllerName . '.php')) {
			require(CONTROLLERS . $this->url->controllerName . '.php');
        	$controller = new $this->url->controllerName;
			if (!empty($this->url->method)){
				$this->callMethod($controller, $this->url->method);
			}else {
				$this->callMethod($controller,'index');
			}
		}else {
			$this->callErrorController();
		}
	}
	/**
	 * Calls the method of the current controller
	 */
	private function callMethod($controller, $method) {
		try {
			if (method_exists($controller, $method)){
				$controller->{$method}();
			}else {
				$this->callErrorController();
			}
		} catch (MegatronException $e){
			echo $e->errorMessage();
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