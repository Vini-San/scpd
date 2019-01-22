<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use\Hcode\Model\Documentos;

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


 ?>