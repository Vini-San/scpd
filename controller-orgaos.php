<?php 

use\Hcode\PageAdmin;
use\Hcode\Model\User;

$app->get("/admin/orgaos", function(){

	User::verifyLogin();

	$orgao = User::listAllOrgao();

	$page = new PageAdmin();

	$page->setTpl("orgaos", array(
		"orgaos"=>$orgao
	));
});

$app->get("/admin/orgaos/create", function(){

	User::verifyLogin();

	$hierarquia = User::listAllHierarquiaOrgao();

	$page = new PageAdmin();

	$page->setTpl("orgaos-create", array(
		"hierarquia"=>$hierarquia
	));
});

$app->get("/admin/orgaos/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$user = new User();

	$user->listOrgaobyId((int)$id_orgao);

	$orgao = User::listAllOrgao();

	$page = new PageAdmin();

	$page->setTpl("orgaos-resultadopororgao", array(
		"users"=>$user->getValues(),
		"orgaos"=>$orgao
	));
});

$app->get("/admin/orgaos/:id_orgao", function($id_orgao){

	User::verifyLogin();

	$user = new User();
	
	$user->listOrgaobyId((int)$id_orgao);

	$orgao = User::listAllOrgao();

	$hierarquia = User::listAllHierarquiaOrgao();

	$page = new PageAdmin();

	$page->setTpl("orgaos-update", array(
		"users"=>$user->getValues(),
		"hierarquia"=>$hierarquia
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