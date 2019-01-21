<?php 
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;


class Documentos extends Model{


	public static function listAllDocs(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM documento d INNER JOIN orgao o on o.id_orgao=d.id_orgao INNER JOIN tipo_documento td on td.id_tipo_documento=d.id_tipo_documento INNER JOIN processo_documento pd on pd.id_processo_documento=d.id_processo_documento INNER JOIN movimento m on m.id_processo_documento=pd.id_processo_documento where m.id_orgao =:orgaolog GROUP BY d.id_documento", array (
			":orgaolog"=>(int)$_SESSION[User::SESSION]['id_orgao']
		));

	}

	public function getDocumentoById($id_documento){

		$sql = new Sql();

		$results = $sql->select("SELECT d.id_documento,d.numero_documento,d.id_tipo_documento,td.tipo_documento, d.id_orgao, o.nome_orgao, d.data_inicio, d.nome_documento, d.assunto_documento, pd.id_processo_documento FROM documento d INNER JOIN orgao o ON o.id_orgao=d.id_orgao INNER JOIN tipo_documento td ON td.id_tipo_documento=d.id_tipo_documento INNER JOIN processo_documento pd ON pd.id_processo_documento=d.id_processo_documento WHERE d.id_documento=:id_documento", array(
			":id_documento"=>$id_documento
		));

		$this->setData($results[0]);
	}

	public function getDocumentoMovimentoById($related = true){

		$sql = new Sql();

		if ($related === true){
		return $sql->select("SELECT m.id_movimento, m.id_tipo_movimento, tm.tipo_movimento, m.proc_data_entrada, m.id_orgao, m.observacoes_proc_entrada, o.nome_orgao, d.id_documento from movimento m INNER JOIN orgao o on o.id_orgao=m.id_orgao INNER JOIN tipo_movimento tm on tm.id_tipo_movimento=m.id_tipo_movimento INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento INNER JOIN documento d on d.id_processo_documento=pd.id_processo_documento WHERE m.id_movimento IN(SELECT m.id_movimento FROM movimento m INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento INNER JOIN documento d on d.id_processo_documento=pd.id_processo_documento where d.id_documento=:id_documento) order by m.id_movimento", [
				":id_documento"=>$this->getid_documento()
			]);
	} else {

		return $sql->select("SELECT m.id_movimento, m.id_tipo_movimento, tm.tipo_movimento, m.proc_data_entrada, m.id_orgao, m.observacoes_proc_entrada, o.nome_orgao, d.id_documento from movimento m INNER JOIN orgao o on o.id_orgao=m.id_orgao INNER JOIN tipo_movimento tm on tm.id_tipo_movimento=m.id_tipo_movimento INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento INNER JOIN documento d on d.id_processo_documento=pd.id_processo_documento WHERE m.id_movimento IN(SELECT m.id_movimento FROM movimento m INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento INNER JOIN documento d on d.id_processo_documento=pd.id_processo_documento where d.id_documento=:id_documento) order by m.id_movimento", [
				":id_documento"=>$this->getid_documento()
			]);

	}

		
		//$this->setData($results[0]);
	}

	public function getMovimentoById($id_movimento){

		$sql = new Sql();

		$results = $sql->select("SELECT m.id_movimento, m.id_tipo_movimento, tm.tipo_movimento, m.proc_data_entrada, m.id_orgao, m.observacoes_proc_entrada, o.nome_orgao from movimento m 
			INNER JOIN orgao o on o.id_orgao=m.id_orgao 
			INNER JOIN tipo_movimento tm on tm.id_tipo_movimento=m.id_tipo_movimento 
			WHERE m.id_movimento=:id_movimento", [

			":id_movimento"=>$id_movimento

		]);

		$this->setData($results[0]);

	}

	public function getOrgaobyId($id_orgao){

		$sql = new Sql();

		$results = $sql->select("SELECT o.id_orgao, o.nome_orgao FROM orgao o INNER JOIN documento d on d.id_orgao=o.id_orgao WHERE o.id_orgao=:id_orgao", array(

			":id_orgao"=>$id_orgao

		));

		$this->setData($results[0]);
	}

	public function getDocumentoByOrgao($related = true){

		$sql = new Sql();

		if ($related === true){
		return $sql->select("SELECT d.id_documento, d.numero_documento, d.id_tipo_documento, d.id_orgao, d.data_inicio,d.nome_documento, d.assunto_documento from documento d INNER JOIN orgao o on o.id_orgao=d.id_orgao where d.id_orgao IN(SELECT o.id_orgao from orgao o where o.id_orgao=:id_orgao)", [
				":id_orgao"=>$this->getid_orgao()
			]);
		} else {
			return $sql->select("SELECT d.id_documento, d.numero_documento, d.id_tipo_documento, d.id_orgao, d.data_inicio,d.nome_documento, d.assunto_documento from documento d INNER JOIN orgao o on o.id_orgao=d.id_orgao where d.id_orgao NOT IN(SELECT o.id_orgao from orgao o where o.id_orgao=:id_orgao))", [
				":id_orgao"=>$this->getid_orgao()
			]);
		}
	}

	public function saveDocs(){

		$sql = new Sql();
		$results = $sql->select("CALL salvardocumento (:numero_documento, :id_orgao, :id_tipo_documento, :data_inicio, :nome_documento, :assunto_documento, :proc_data_entrada, :id_orgao_movimento, :observacoes)", array(

			":numero_documento"=>$this->getnumero_documento(),
			":id_orgao"=>$this->getid_orgao(),
			":id_tipo_documento"=>$this->getid_tipo_documento(),
			":data_inicio"=>$this->getdata_inicio(),
			":nome_documento"=>$this->getnome_documento(),
			":assunto_documento"=>$this->getassunto_documento(),
			":proc_data_entrada"=>$this->getproc_data_entrada(),
			":id_orgao_movimento"=>$this->getid_orgao_movimento(),
			":observacoes"=>$this->getobservacoes()
		));

		$this->setData($results[0]);

	}

	public function saveMovimentoDocumento(){

		$sql = new Sql();
		$sql->select("CALL salvarmovimentodocumento (:id_documento,:id_tipo_movimento,:proc_data_entrada,:id_orgao_movimento,:observacoes)", array(

			":id_documento"=>$this->getid_documento(),
			":id_tipo_movimento"=>$this->getid_tipo_movimento(),
			":proc_data_entrada"=>$this->getproc_data_entrada(),
			":id_orgao_movimento"=>$this->getid_orgao_movimento(),
			":observacoes"=>$this->getobservacoes()
		));

	}

	public function updateDoc(){

		$sql = new Sql();
		$sql->query("UPDATE documento d SET d.numero_documento=:numero_documento, d.id_orgao=:id_orgao, d.id_tipo_documento=:id_tipo_documento, d.data_inicio=:data_inicio, d.nome_documento=:nome_documento, d.assunto_documento=:assunto_documento WHERE d.id_documento=:id_documento", array(
			":id_documento"=>$this->getid_documento(),
			":numero_documento"=>$this->getnumero_documento(),
			":id_orgao"=>$this->getid_orgao(),
			":id_tipo_documento"=>$this->getid_tipo_documento(),
			":data_inicio"=>$this->getdata_inicio(),
			":nome_documento"=>$this->getnome_documento(),
			":assunto_documento"=>$this->getassunto_documento()
		));

		//$this->setData($results[0]);

	}

	public function updateMovimento(){

		$sql = new Sql();
		$sql->query("UPDATE movimento m SET m.id_tipo_movimento=:id_tipo_movimento, m.proc_data_entrada=:proc_data_entrada, m.id_orgao=:id_orgao, m.observacoes_proc_entrada=:observacoes_proc_entrada WHERE m.id_movimento=:id_movimento", array(
			":id_movimento"=>$this->getid_movimento(),
			":id_tipo_movimento"=>$this->getid_tipo_movimento(),
			":proc_data_entrada"=>$this->getproc_data_entrada(),
			":id_orgao"=>$this->getid_orgao(),
			":observacoes_proc_entrada"=>$this->getobservacoes_proc_entrada()
		));

		//$this->setData($results[0]);

	}

}


 ?>