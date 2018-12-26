<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use\Hcode\Page;
use\Hcode\PageAdmin;
use\Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	User::verifyLogin();
	
	$page = new Page();

	$page->setTpl("index");
});

$app->get('/admin', function() {
    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");
});

$app->get('/admin/login',function(){
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login");
});

$app->post('/admin/login',function(){
	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");

	exit;
});

$app->get('/admin/logout',function(){
	
	User::logout();

	header("Location: /admin/login");
});
//quando entra na página de consulta
$app->get("/admin/users", function(){

	User::verifyLogin();

	$user = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$user
	));
});

//quando vai para página de insert
$app->get("/admin/users/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$user = User::listAllOrgao();

	$page->setTpl("users-create", array(
		"user"=>$user
	));
});

//quando vai para página de update
$app->get("/admin/users/:id_processo/delete", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$user->delete();

	header("Location: /admin/users");

	exit;


});

$app->get("/admin/users/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));
});

//inserindo dados no banco
$app->post("/admin/users/create", function(){

	User::verifyLogin();
	User::listAllOrgao();

	$user = new User();

	$user->setData($_POST);

	$user->saveProcess();	

	header("Location: /admin/users");

	exit;


});

//para modificar dados no banco
$app->post("/admin/users/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);
	$user->setData($_POST);
	$user->update();

	header("Location: /admin/users");
	exit;

});




//agora vem a parte dos documentos




//quando entra na página de consulta
$app->get("/admin/docs", function(){

	User::verifyLogin();

	$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("docs", array(
		"users"=>$users
	));
});

//quando vai para página de insert
$app->get("/admin/docs/docs-create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("docs-create");
});

//quando vai para página de update

$app->get("/admin/docs/:iddocs", function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$iduser);

	$page = new PageAdmin();

	$page->setTpl("docs-update", array(
		"user"=>$user->getValues()
	));
});

//inserindo dados no banco
$app->post("/admin/docs/docs-create", function(){

	User::verifyLogin();

	$user = new User();

	$user->setData($_POST);

	$user->saveProcess();	

	header("Location: /admin/docs");

	exit;


});

//para modificar dados no banco
$app->post("/admin/docs/:iduser", function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$iduser);
	$user->setData($_POST);
	$user->update();

	header("Location: /admin/docs");
	exit;

});

$app->run();

 ?>