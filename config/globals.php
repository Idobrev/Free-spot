<?php 
define('BASE_PATH', dirname(realpath(__DIR__)) . DIRECTORY_SEPARATOR);
define('LIBRARIES', BASE_PATH . 'libraries' . DIRECTORY_SEPARATOR);
define('CONTROLLERS', BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR);
define('VALIDATORS', BASE_PATH . 'validators' . DIRECTORY_SEPARATOR);
define('VIEWS', BASE_PATH . 'views' . DIRECTORY_SEPARATOR);
define('MODELS', BASE_PATH . 'models' . DIRECTORY_SEPARATOR);
//Matches the public path to megatron.
$match = preg_match('/.+(?:\\\|\\/)www(\\\.+|\\/.+)/', BASE_PATH, $matches); // three escape slashes. Cuz fun is here, fun is now. Should work with 2 but we must escape the escape in regex
if ($match === 1) {
	define('PUBLIC_PATH', str_replace('\\', '/', $matches[1]) . 'public' . DIRECTORY_SEPARATOR);
	define('URL', str_replace('\\', '/', $matches[1]));
} else {
	throw new MegatronException("Unable to locate 'www' folder", 1);
}
?>