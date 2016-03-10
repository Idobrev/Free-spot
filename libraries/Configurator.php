<?php
/**
 * 
 */
class Configurator {
	
	/* Holds configuration */
	private static $config;
	
	static function parseConfiguration() {
		self::$config = parse_ini_file(BASE_PATH . 'config' . DIRECTORY_SEPARATOR . 'config.ini');
	}
	
	static function getField($field) {
		if ( $field !== '' && isset(self::$config[$field]) ) {
			return self::$config[$field];
		}else {
			throw new MegatronException("Field not found in configuration file", 1);
		}
	}
}

?>