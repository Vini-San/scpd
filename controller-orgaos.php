<?php 

use\Hcode\PageAdmin;
use\Hcode\Model\User;

$app->get("/admin/orgaos", function(){

	User::verifyLogin();

	$orgao = User::listAllOrgao();
	$user = User::ShowUserSession();

	$page = new PageAdmin();

	$page->setTpl("orgaos", array(
		"orgaos"=>$orgao,
		"user"=>$user
	));
});

$app->get("/admin/orgaos/create", function(){

	User::verifyLogin();

	$hierarquia = User::listAllHierarquiaOrgao();
	$user = User::ShowUserSession();

	$page = new PageAdmin();

	$page->setTpl("orgaos-create", array(
		"hierarquia"=>$hierarquia,
		"user"=>$user
	));
});

$app->get("/admin/orgaos/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$users = new User();

	$users->listOrgaobyId((int)$id_orgao);
	$user = User::ShowUserSession();

	$orgao = User::listAllOrgao();

	$page = new PageAdmin();

	$page->setTpl("orgaos-resultadopororgao", array(
		"users"=>$users->getValues(),
		"orgaos"=>$orgao,
		"user"=>$user
	));
});

$app->get("/admin/orgaos/:id_orgao", function($id_orgao){

	User::verifyLogin();

	$users = new User();
	
	$users->listOrgaobyId((int)$id_orgao);

	$user = User::ShowUserSession();

	$orgao = User::listAllOrgao();

	$hierarquia = User::listAllHierarquiaOrgao();

	$page = new PageAdmin();

	$page->setTpl("orgaos-update", array(
		"users"=>$users->getValues(),
		"hierarquia"=>$hierarquia,
		"user"=>$user
	));
});

$app->post("/admin/orgaos/create", function(){

	User::verifyLogin();

	$user = new User();

	$user->setData($_POST);
	$user->saveOrgao();

	header("Location: /admin/orgaos");
	exit;
});

$app->post("/admin/orgaos/:id_orgao", function($id_orgao){

	User::verifyLogin();

	$user = new User();

	$user->listOrgaobyId((int)$id_orgao);
	$user->setData($_POST);
	$user->updateOrgao();

	header("Location: /admin/orgaos");
	exit;
});


 ?>