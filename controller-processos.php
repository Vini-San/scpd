<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use\Hcode\Model\Processo;

//quando entra na página para consultar todos os processos
$app->get("/admin/processos", function(){

	User::verifyLogin();

	$processos = Processo::listAllProcesso();

	$user = User::ShowUserSession();

	$page = new PageAdmin();

	$page->setTpl("processos", array(
		"user"=>$user,
		"processos"=>$processos
	));
});

//tela para mostrar orgãos na parte de processos
$app->get("/admin/processos/pororgao", function(){

	User::verifyLogin();

	$orgao = User::listAllProcessoOrgaoActive();

	$user = User::ShowUserSession();

	$page = new PageAdmin();

	$page->setTpl("processos-pororgao", array(
		"orgao"=>$orgao,
		"user"=>$user

	));
});

//tela para mostrar resultado da busca de processos por orgãos
$app->get("/admin/processos/:id_orgao/resultadopororgao", function($id_orgao){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getOrgaobyId((int)$id_orgao);

	$user = User::ShowUserSession();

	$orgao = User::listAllProcessoOrgaoActive();

	$page = new PageAdmin();

	$page->setTpl("processos-resultadopororgao", array(
		"processo"=>$processo->getValues(),
		"resultadoprocesso"=>$processo->getProcessoByOrgao(),
		"semprocesso"=>$processo->getProcessoByOrgao(false),
		"orgao"=>$orgao,
		"user"=>$user
	));
});

//tela com situação do processo com os dados e os movimentos
$app->get("/admin/processos/situacao/:id_processo", function($id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$user = User::ShowUserSession();

	$page = new PageAdmin();

	$page->setTpl("processos-situacao", array(
		"processo"=>$processo->getValues(),
		"movimento"=>$processo->getProcessoMovimentoById(),
		"sem movimento"=>$processo->getProcessoMovimentoById(false),
		"user"=>$user
	));
});

//tela para inserir novo movimento
$app->get("/admin/processos/movimentar/:id_processo", function($id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$user = User::ShowUserSession();

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
		"tipo"=>$tipo,
		"user"=>$user
	));
});

//tela para editar movimento
$app->get("/admin/processos/:id_movimento/editarmovimento/:id_processo", function($id_movimento, $id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$user = User::ShowUserSession();

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
		"tipo"=>$tipo,
		"user"=>$user
	));
});

//tela que insere os dados do processo e sua entrada
$app->get("/admin/processos/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$user = User::ShowUserSession();

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();

	$page->setTpl("processos-create", array(
		"user"=>$user,
		"orgao"=>$orgao,
		"tipo"=>$tipo
	));
});

//tela de consulta com todos os processos cadastrados
$app->get("/admin/processos/:id_processo", function($id_processo){

	User::verifyLogin();

	$processo = new Processo();

	$processo->getProcessoById((int)$id_processo);

	$user = User::ShowUserSession();

	$orgao = User::listAllOrgao();
	$tipo = User::listAllTipo();

	$page = new PageAdmin();

	$page->setTpl("processos-update", array(
		"processo"=>$processo->getValues(),
		"orgao"=>$orgao,
		"tipo"=>$tipo,
		"user"=>$user
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

?>