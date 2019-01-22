<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use\Hcode\Page;
use\Hcode\PageAdmin;
use\Hcode\Model\User;
use\Hcode\Model\Processo;
use\Hcode\Model\Documentos;
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

	$user = User::listAllUsuario();

	$page = new PageAdmin();

	$page->setTpl("index", array(
		"users"=>$user
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




//////////////////////////////////////////////////////////////////////////////////////////
//parte dos processos

//quando entra na página para consultar todos os processos
$app->get("/admin/processos", function(){

	User::verifyLogin();

	$processos = Processo::listAllProcesso();

	$page = new PageAdmin();

	$page->setTpl("processos", array(
		"processos"=>$processos
	));
});

//tela para mostrar orgãos na parte de processos
$app->get("/admin/processos/pororgao", function(){

	User::verifyLogin();

	$orgao = User::listAllProcessoOrgaoActive();

	$page = new PageAdmin();

	$page->setTpl("processos-pororgao", array(
		"orgao"=>$orgao

	));
});

//tela para mostrar resultado da busca de processos por orgãos
$app->get("/admin/processos/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getOrgaobyId((int)$id_orgao);

	$orgao = User::listAllProcessoOrgaoActive();

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

//tela para editar movimento
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
//quando entra na página para consultar todos os processos
$app->get("/admin/docs", function(){

	User::verifyLogin();

	$docs = Documentos::listAllDocs();

	$page = new PageAdmin();

	$page->setTpl("docs", array(
		"docs"=>$docs
	));
});

$app->get("/admin/docs/pororgao", function(){

	User::verifyLogin();

	$orgao = User::listAllDocumentoOrgaoActive();

	$page = new PageAdmin();

	$page->setTpl("docs-pororgao", array(
		"orgao"=>$orgao

	));
});

$app->get("/admin/docs/situacao/:id_documento", function($id_documento){

	User::verifyLogin();

	$docs = new Documentos();

	$docs->getDocumentoById((int)$id_documento);

	$page = new PageAdmin();

	$page->setTpl("docs-situacao", array(
		"docs"=>$docs->getValues(),
		"movimento"=>$docs->getDocumentoMovimentoById(),
		"sem movimento"=>$docs->getDocumentoMovimentoById(false)
	));
});

$app->get("/admin/docs/movimentar/:id_documento", function($id_documento){

	User::verifyLogin();

	$docs = new Documentos();

	$docs->getDocumentoById((int)$id_documento);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipoDocumento();
	$tipomovimento = User::listAllTipoMovimento();

	$page = new PageAdmin();

	$page->setTpl("docs-movimentar", array(
		"docs"=>$docs->getValues(),
		"movimento"=>$docs->getDocumentoMovimentoById(),
		"sem movimento"=>$docs->getDocumentoMovimentoById(false),
		"tipomovimento"=>$tipomovimento,
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

$app->get("/admin/docs/:id_movimento/editarmovimento/:id_documento", function($id_movimento, $id_documento){

	User::verifyLogin();

	$docs = new Documentos();

	$docs->getDocumentoById((int)$id_documento);

	$movimento = new Documentos();

	$movimento->getMovimentoById((int)$id_movimento);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipoDocumento();
	$tipomovimento = User::listAllTipoMovimento();

	$page = new PageAdmin();

	$page->setTpl("docs-editarmovimento", array(
		"docs"=>$docs->getValues(),
		"movimento"=>$movimento->getValues(),
		"tipomovimento"=>$tipomovimento,
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

//tela que insere os dados do processo e sua entrada
$app->get("/admin/docs/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipoDocumento();

	$page->setTpl("docs-create", array(
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

//tela de consulta com todos os processos cadastrados
$app->get("/admin/docs/:id_documento", function($id_documento){

	User::verifyLogin();

	$docs = new Documentos();

	$docs->getDocumentoById((int)$id_documento);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipoDocumento();

	$page = new PageAdmin();

	$page->setTpl("docs-update", array(
		"docs"=>$docs->getValues(),
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

$app->get("/admin/docs/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$docs = new Documentos();

	$docs->getOrgaobyId((int)$id_orgao);

	$orgao = User::listAllDocumentoOrgaoActive();

	$page = new PageAdmin();

	$page->setTpl("docs-resultadopororgao", array(
		"docs"=>$docs->getValues(),
		"resultadodocumento"=>$docs->getDocumentoByOrgao(),
		"semprocesso"=>$docs->getDocumentoByOrgao(false),
		"orgao"=>$orgao
	));
});



$app->post("/admin/docs/movimentar/:id_documento/add", function($id_documento){

	User::verifyLogin();

	$docs = new Documentos();

	$docs->getDocumentoById((int)$id_documento);

	$_POST["proc_data_entrada"] = date("Y-m-d", strtotime($_POST["proc_data_entrada"]));
	
	$docs->setData($_POST);
	$docs->saveMovimentoDocumento();	

	header("Location: /admin/docs/situacao/".$id_documento);
	exit;
});

//controle para inserir dados do processo e primeira movimentação
$app->post("/admin/docs/create", function(){

	User::verifyLogin();

	$docs = new Documentos();

	$_POST["data_inicio"] = date("Y-m-d", strtotime($_POST["data_inicio"]));
	
	$_POST["proc_data_entrada"] = date("Y-m-d", strtotime($_POST["proc_data_entrada"]));

	$docs->setData($_POST);

	$docs->saveDocs();	

	header("Location: /admin/docs");

	exit;
});

//controle para modificar dados do processo
$app->post("/admin/docs/:id_documento", function($id_documento){

	User::verifyLogin();

	$docs = new Documentos();

	$_POST["data_inicio"] = implode('-', array_reverse(explode('/', ($_POST["data_inicio"]))));

	$docs->getDocumentoById((int)$id_documento);
	$docs->setData($_POST);
	$docs->updateDoc();

	header("Location: /admin/docs/situacao/".$id_documento);
	exit;

});

$app->post("/admin/docs/editarmovimento/:id_documento/update", function($id_documento){

	User::verifyLogin();

	$docs = new Documentos();

	$docs->getDocumentoById((int)$id_documento);

	$_POST["proc_data_entrada"] = implode('-', array_reverse(explode('/', ($_POST["proc_data_entrada"]))));
	
	$docs->setData($_POST);
	
	$docs->updateMovimento();


	header("Location: /admin/docs/situacao/".$id_documento);
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


$app->run();

 ?>