<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use\Hcode\Page;
use\Hcode\PageAdmin;
use\Hcode\Model\User;
use\Hcode\Model\Processo;
//use\Hcode\Model\ProcessoDocumento;

function formatDate($date)
{

	return date('d/m/Y', strtotime($date));

}

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	User::verifyLogin();
	
	$page = new PageAdmin();

	$page->setTpl("admin/index");
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
	exit;
});

//quando entra na página de consulta
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

	header("Location: /admin/users");
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




//////////////////////////////////////////////////////////////////////////////////////////
//parte dos processos



//quando entra na página de consulta
$app->get("/admin/processos", function(){

	User::verifyLogin();

	$processos = Processo::listAllProcesso();

	$page = new PageAdmin();

	$page->setTpl("processos", array(
		"processos"=>$processos
	));
});

$app->get("/admin/processos/pororgao", function(){

	User::verifyLogin();

	$orgao = User::listAllOrgaoActive();

	$page = new PageAdmin();

	$page->setTpl("processos-pororgao", array(
		"orgao"=>$orgao

	));
});

$app->get("/admin/processos/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getOrgaobyId((int)$id_orgao);

	$orgao = User::listAllOrgaoActive();

	$page = new PageAdmin();

	$page->setTpl("processos-resultadopororgao", array(
		"processo"=>$processo->getValues(),
		"resultadoprocesso"=>$processo->getProcessoByOrgao(),
		"semprocesso"=>$processo->getProcessoByOrgao(false),
		"orgao"=>$orgao
	));
});

//tela com situação do processo com os dados e os movimentos
$app->get("/admin/processos/situacao/:id_processo", function($id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$page = new PageAdmin();

	$page->setTpl("processos-situacao", array(
		"processo"=>$processo->getValues(),
		"movimento"=>$processo->getProcessoMovimentoById(),
		"sem movimento"=>$processo->getProcessoMovimentoById(false)
	));
});


//tela para inserir novo movimento
$app->get("/admin/processos/movimentar/:id_processo", function($id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();
	$tipomovimento = User::listAllTipoMovimento();

	$page = new PageAdmin();

	$page->setTpl("processos-movimentar", array(
		"processo"=>$processo->getValues(),
		"movimento"=>$processo->getProcessoMovimentoById(),
		"sem movimento"=>$processo->getProcessoMovimentoById(false),
		"tipomovimento"=>$tipomovimento,
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

$app->get("/admin/processos/:id_movimento/editarmovimento/:id_processo", function($id_movimento, $id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$movimento = new Processo();

	$movimento->getMovimentoById((int)$id_movimento);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();
	$tipomovimento = User::listAllTipoMovimento();

	$page = new PageAdmin();

	$page->setTpl("processos-editarmovimento", array(
		"processo"=>$processo->getValues(),
		"movimento"=>$movimento->getValues(),
		"tipomovimento"=>$tipomovimento,
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

//tela que insere os dados do processo e sua entrada
$app->get("/admin/processos/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();

	$page->setTpl("processos-create", array(
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

//tela de consulta com todos os processos cadastrados
$app->get("/admin/processos/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new Processo();

	$user->getProcessoById((int)$id_processo);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();

	$page = new PageAdmin();

	$page->setTpl("processos-update", array(
		"user"=>$user->getValues(),
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});


//controle pra inserir novo movimento
$app->post("/admin/processos/movimentar/:id_processo/add", function($id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$_POST["proc_data_entrada"] = date("Y-m-d", strtotime($_POST["proc_data_entrada"]));
	
	$processo->setData($_POST);
	$processo->saveMovimentoProcesso();	

	header("Location: /admin/processos/situacao/".$id_processo);
	exit;

});

//controle para inserir dados do processo e primeira movimentação
$app->post("/admin/processos/create", function(){

	User::verifyLogin();

	$processo = new Processo();

	$_POST["data_inicio"] = date("Y-m-d", strtotime($_POST["data_inicio"]));
	
	$_POST["proc_data_entrada"] = date("Y-m-d", strtotime($_POST["proc_data_entrada"]));

	$processo->setData($_POST);

	$processo->saveProcesso();	

	header("Location: /admin/processos");

	exit;


});


//controle para modificar dados do processo
$app->post("/admin/processos/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new Processo();

	$_POST["data_inicio"] = implode('-', array_reverse(explode('/', ($_POST["data_inicio"]))));

	$user->getProcessoById((int)$id_processo);
	$user->setData($_POST);
	$user->updateProcesso();

	header("Location: /admin/processos/situacao/".$id_processo);
	exit;

});

$app->post("/admin/processos/editarmovimento/:id_processo/update", function($id_processo){

	User::verifyLogin();

	$user = new Processo();

	$user->getProcessoById((int)$id_processo);

	$_POST["proc_data_entrada"] = implode('-', array_reverse(explode('/', ($_POST["proc_data_entrada"]))));
	
	$user->setData($_POST);
	
	$user->updateMovimento();


	header("Location: /admin/processos/situacao/".$id_processo);
	exit;

});


//////////////////////////////////////////////////////////////////////////////////////////
//agora vem a parte dos documentos




//quando entra na página de consulta
$app->get("/admin/docs", function(){

	User::verifyLogin();

	$users = Processo::listAllProcesso();

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

/////////////////////////////////////////////////////////////
//parte de órgãos

//quando vai para página de insert
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


$app->run();

 ?>