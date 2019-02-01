<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;

$app = new Slim();

$app->config('debug', true);

require_once("controller-admin-login.php");
require_once("controller-processos.php");
require_once("controller-documentos.php");
require_once("controller-users.php");
require_once("controller-orgaos.php");
require_once("controller-functions.php");

$app->run();

 ?>