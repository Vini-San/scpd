<?php 
use\Hcode\PageAdmin;
use\Hcode\Model\User;

$app->get("/admin/users", function(){

	User::verifyLogin();

	$user = User::listAllUsuario();
	$orgao = User::listOrgaoByUsuarioActive();

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$user,
		"orgao"=>$orgao,
	));
});

//tela que insere os dados do usuário
$app->get("/admin/users/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$orgao = User::listAllOrgaoIntern();
	$nivel = User::listAllNivelUsuario();
	$situacao = User::listAllSituacaoUsuario();

	$page->setTpl("users-create", array(
		"orgao"=>$orgao,
		"nivel"=>$nivel,
		"situacao"=>$situacao
	));
});

//tela de consulta com todos os usuários cadastrados
$app->get("/admin/users/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$user = new User();

	$user->listUsuarioById((int)$id_usuario);

	$orgao = User::listAllOrgao();
	$nivel = User::listAllNivelUsuario();
	$situacao = User::listAllSituacaoUsuario();

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues(),
		"orgao"=>$orgao,
		"nivel"=>$nivel,
		"situacao"=>$situacao
	));
});

$app->get("/admin/users/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$user = new User();

	$user->getOrgaobyId((int)$id_orgao);

	$orgao = User::listOrgaoByUsuarioActive();

	$page = new PageAdmin();

	$page->setTpl("users-resultadopororgao", array(
		"users"=>$user->getValues(),
		"resultadousuario"=>$user->listUsuarioByOrgao(),
		"semusuario"=>$user->listUsuarioByOrgao(false),
		"orgao"=>$orgao
	));
});

$app->get("/admin/updatepassword/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$user = new User();

	$user->listUsuarioById((int)$id_usuario);

	$orgao = User::listAllOrgao();
	$nivel = User::listAllNivelUsuario();
	$situacao = User::listAllSituacaoUsuario();

	$page = new PageAdmin();

	$page->setTpl("users-updatepassword", array(
		"user"=>$user->getValues(),
		"orgao"=>$orgao,
		"nivel"=>$nivel,
		"situacao"=>$situacao
	));
});

//tela com situação do processo com os dados e os movimentos
$app->get("/admin/users/situacao/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$user = new User();

	$user->listUsuarioById((int)$id_usuario);

	$page = new PageAdmin();

	$page->setTpl("users-situacao", array(
		"user"=>$user->getValues()
	));
});

//controle para inserir dados do usuário
$app->post("/admin/users/create", function(){

	User::verifyLogin();

	$user = new User();

	$user->setData($_POST);

	$user->saveUsuario();	

	header("Location: /admin/users");
	exit;
});

//controle para modificar dados do usuário
$app->post("/admin/users/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$user = new User();

	$user->listUsuarioById((int)$id_usuario);
	$user->setData($_POST);
	$user->updateUsuario();

	header("Location: /admin/users/situacao/".$id_usuario);
	exit;

});

$app->post("/admin/updatepassword/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$user = new User();

	$user->listUsuarioById((int)$id_usuario);
	$user->setData($_POST);
	$user->updatePassword();

	header("Location: /admin/users");
	exit;

});

 ?>