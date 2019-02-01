<?php 
use\Hcode\PageAdmin;
use\Hcode\Model\User;

$app->get("/admin/users", function(){

	User::verifyLogin();

	$users = User::listAllUsuario();
	$orgao = User::listOrgaoByUsuarioActive();
	$user = User::ShowUserSession();

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$users,
		"orgao"=>$orgao,
		"user"=>$user
	));
});

//tela que insere os dados do usuário
$app->get("/admin/users/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$user = User::ShowUserSession();

	$orgao = User::listAllOrgaoIntern();
	$nivel = User::listAllNivelUsuario();
	$situacao = User::listAllSituacaoUsuario();

	$page->setTpl("users-create", array(
		"orgao"=>$orgao,
		"nivel"=>$nivel,
		"situacao"=>$situacao,
		"user"=>$user
	));
});

//tela de consulta com todos os usuários cadastrados
$app->get("/admin/users/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$users = new User();

	$users->listUsuarioById((int)$id_usuario);

	$user = User::ShowUserSession();
	$orgao = User::listAllOrgao();
	$nivel = User::listAllNivelUsuario();
	$situacao = User::listAllSituacaoUsuario();

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"users"=>$users->getValues(),
		"orgao"=>$orgao,
		"nivel"=>$nivel,
		"situacao"=>$situacao,
		"user"=>$user
	));
});

$app->get("/admin/users/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$users = new User();

	$users->getOrgaobyId((int)$id_orgao);

	$user = User::ShowUserSession();
	$orgao = User::listOrgaoByUsuarioActive();

	$page = new PageAdmin();

	$page->setTpl("users-resultadopororgao", array(
		"users"=>$users->getValues(),
		"resultadousuario"=>$user->listUsuarioByOrgao(),
		"semusuario"=>$user->listUsuarioByOrgao(false),
		"orgao"=>$orgao,
		"user"=>$user
	));
});

$app->get("/admin/updatepassword/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$users = new User();

	$users->listUsuarioById((int)$id_usuario);

	$user = User::ShowUserSession();
	$orgao = User::listAllOrgao();
	$nivel = User::listAllNivelUsuario();
	$situacao = User::listAllSituacaoUsuario();

	$page = new PageAdmin();

	$page->setTpl("users-updatepassword", array(
		"users"=>$users->getValues(),
		"orgao"=>$orgao,
		"nivel"=>$nivel,
		"situacao"=>$situacao,
		"user"=>$user
	));
});

//tela com situação do processo com os dados e os movimentos
$app->get("/admin/users/situacao/:id_usuario", function($id_usuario){

	User::verifyLogin();

	$users = new User();

	$users->listUsuarioById((int)$id_usuario);

	$user = User::ShowUserSession();
	$page = new PageAdmin();

	$page->setTpl("users-situacao", array(
		"users"=>$users->getValues(),
		"user"=>$user
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