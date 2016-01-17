<?php
error_reporting(E_ALL);
require (dirname(__FILE__) . '\config\globals.php');
//Libraries
require (LIBRARIES . 'Application.php');
require (LIBRARIES . 'Controller.php');
require (LIBRARIES . 'View.php');
require (LIBRARIES . 'Model.php');
require (LIBRARIES . 'Session.php');
require (LIBRARIES . 'Validator.php');
require (LIBRARIES . 'MegatronException.php');

$application = new Application();
$application->startSession();
$application->parseURL();
$application->callController();
//$application->renderView();
//echo BASE_PATH;

?>