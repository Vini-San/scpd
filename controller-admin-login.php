<?php 

use\Hcode\PageAdmin;
use\Hcode\Model\User;

$app->get('/', function() {

	User::verifyLogin();
	
	$page = new PageAdmin();

	$page->setTpl("admin/index");
});

$app->get('/admin', function() {
    
	User::verifyLogin();

	$user = User::ShowUserSession();

	$page = new PageAdmin();

	$page->setTpl("index", array(
		"user"=>$user
	));
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
	exit;
});
 ?>