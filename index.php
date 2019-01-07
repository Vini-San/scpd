<?php 

session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use\Hcode\Page;
use\Hcode\PageAdmin;
use\Hcode\Model\User;
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
});

//quando entra na página de consulta
$app->get("/admin/users", function(){

	User::verifyLogin();

	$user = User::listAllProcesso();

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$user
	));
});

$app->get("/admin/users/pororgao", function(){

	User::verifyLogin();

	$orgao = User::listAllOrgao();

	$page = new PageAdmin();

	$page->setTpl("users-pororgao", array(
		"orgao"=>$orgao

	));
});

$app->get("/admin/users/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$user = new User();

	$user->getOrgaobyId((int)$id_orgao);

	$orgao = User::listAllOrgao();

	$page = new PageAdmin();

	$page->setTpl("users-resultadopororgao", array(
		"user"=>$user->getValues(),
		"processo"=>$user->getProcessoByOrgao(),
		"semprocesso"=>$user->getProcessoByOrgao(false),
		"orgao"=>$orgao
	));
});

//tela com situação do processo com os dados e os movimentos
$app->get("/admin/users/situacao/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$page = new PageAdmin();

	$page->setTpl("users-situacao", array(
		"user"=>$user->getValues(),
		"movimento"=>$user->getProcessoMovimentoById(),
		"sem movimento"=>$user->getProcessoMovimentoById(false)
	));
});


//tela para inserir novo movimento
$app->get("/admin/users/movimentar/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();
	$tipomovimento = User::listAllTipoMovimento();

	$page = new PageAdmin();

	$page->setTpl("users-movimentar", array(
		"user"=>$user->getValues(),
		"movimento"=>$user->getProcessoMovimentoById(),
		"sem movimento"=>$user->getProcessoMovimentoById(false),
		"tipomovimento"=>$tipomovimento,
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

$app->get("/admin/users/:id_movimento/editarmovimento/:id_processo", function($id_movimento, $id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$movimento = new User();

	$movimento->getMovimentoById((int)$id_movimento);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();
	$tipomovimento = User::listAllTipoMovimento();

	$page = new PageAdmin();

	$page->setTpl("users-editarmovimento", array(
		"user"=>$user->getValues(),
		"movimento"=>$movimento->getValues(),
		"tipomovimento"=>$tipomovimento,
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

//tela que insere os dados do processo e sua entrada
$app->get("/admin/users/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();

	$page->setTpl("users-create", array(
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

//tela de deleção
$app->get("/admin/users/:id_processo/delete", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$user->delete();

	header("Location: /admin/users");

	exit;


});

//tela de consulta com todos os processos cadastrados
$app->get("/admin/users/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues(),
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});


//controle pra inserir novo movimento
$app->post("/admin/users/movimentar/:id_processo/add", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);
	
	$user->setData($_POST);
	$user->saveMovimento();	

	header("Location: /admin/users/situacao/".$id_processo);
	exit;

});

//controle para inserir dados do processo e primeira movimentação
$app->post("/admin/users/create", function(){

	User::verifyLogin();

	$user = new User();

	$_POST["data_inicio"] = date("Y-m-d", strtotime($_POST["data_inicio"]));
	
	$_POST["proc_data_entrada"] = date("Y-m-d", strtotime($_POST["proc_data_entrada"]));

	$user->setData($_POST);

	$user->saveProcesso();	

	header("Location: /admin/users");

	exit;


});


//controle para modificar dados do processo
$app->post("/admin/users/:id_processo", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$_POST["data_inicio"] = implode('-', array_reverse(explode('/', ($_POST["data_inicio"]))));

	$user->getProcessoById((int)$id_processo);
	$user->setData($_POST);
	$user->updateProcesso();

	header("Location: /admin/users");
	exit;

});

$app->post("/admin/users/editarmovimento/:id_processo/update", function($id_processo){

	User::verifyLogin();

	$user = new User();

	$user->getProcessoById((int)$id_processo);

	$_POST["proc_data_entrada"] = implode('-', array_reverse(explode('/', ($_POST["proc_data_entrada"]))));
	
	$user->setData($_POST);
	
	$user->updateMovimento();


	header("Location: /admin/users/situacao/".$id_processo);
	exit;

});



//agora vem a parte dos documentos




//quando entra na página de consulta
$app->get("/admin/docs", function(){

	User::verifyLogin();

	$users = User::listAllProcesso();

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