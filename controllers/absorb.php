<?php
/**
 * Absorb controller.
 * Default controller when Megatron is in absorb mode.
 */
class Absorb extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index($args) {
		echo 'Absorbing';
	}
}

?>