<?php 
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;


class Processo extends Model{


	public static function listAllProcesso(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM processo p INNER JOIN orgao o on o.id_orgao=p.id_orgao INNER JOIN tipo_processo tp on tp.id_tipo_processo=p.id_tipo_processo INNER JOIN processo_documento pd on pd.id_processo_documento=p.id_processo_documento GROUP BY p.id_processo");

	}

	public function getProcessoById($id_processo){

		$sql = new Sql();

		$results = $sql->select("SELECT p.id_processo, p.numero_processo, p.id_tipo_processo, tp.tipo_processo, p.id_orgao, o.nome_orgao, p.data_inicio, p.nome_processo, p.assunto_processo, pd.id_processo_documento FROM processo p INNER JOIN orgao o on o.id_orgao=p.id_orgao INNER JOIN tipo_processo tp on tp.id_tipo_processo=p.id_tipo_processo INNER JOIN processo_documento pd on pd.id_processo_documento=p.id_processo_documento WHERE p.id_processo=:id_processo GROUP BY p.id_processo", array(

			":id_processo"=>$id_processo

		));

		$this->setData($results[0]);
	}

	public function getProcessoMovimentoById($related = true){

		$sql = new Sql();

		if ($related === true){
		return $sql->select("SELECT m.id_movimento, m.id_tipo_movimento, tm.tipo_movimento, m.proc_data_entrada, m.id_orgao, m.observacoes_proc_entrada, o.nome_orgao, p.id_processo from movimento m 
			INNER JOIN orgao o on o.id_orgao=m.id_orgao 
			INNER JOIN tipo_movimento tm on tm.id_tipo_movimento=m.id_tipo_movimento 
			INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento 
			INNER JOIN processo p on p.id_processo_documento=pd.id_processo_documento
			WHERE m.id_movimento IN(
			SELECT m.id_movimento 
			FROM movimento m 
			INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento 
			INNER JOIN processo p on p.id_processo_documento=pd.id_processo_documento 
			where p.id_processo =:id_processo) order by m.id_movimento", [
				":id_processo"=>$this->getid_processo()
			]);
	} else {

		return $sql->select("SELECT m.id_movimento, m.id_tipo_movimento, tm.tipo_movimento, m.proc_data_entrada, m.id_orgao, m.observacoes_proc_entrada, o.nome_orgao, p.id_processo from movimento m 
			INNER JOIN orgao o on o.id_orgao=m.id_orgao 
			INNER JOIN tipo_movimento tm on tm.id_tipo_movimento=m.id_tipo_movimento 
			INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento 
			INNER JOIN processo p on p.id_processo_documento=pd.id_processo_documento
			WHERE m.id_movimento not IN(
			SELECT m.id_movimento 
			FROM movimento m 
			INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento 
			INNER JOIN processo p on p.id_processo_documento=pd.id_processo_documento 
			where p.id_processo =:id_processo) order by m.id_movimento", [
				":id_processo"=>$this->getid_processo()
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

		$results = $sql->select("SELECT o.id_orgao, o.nome_orgao FROM orgao o INNER JOIN processo p on p.id_orgao=o.id_orgao WHERE o.id_orgao=:id_orgao", array(

			":id_orgao"=>$id_orgao

		));

		$this->setData($results[0]);
	}

	public function getProcessoByOrgao($related = true){

		$sql = new Sql();

		if ($related === true){
		return $sql->select("SELECT p.id_processo, p.numero_processo, p.id_tipo_processo, p.id_orgao, p.data_inicio, p.nome_processo, p.assunto_processo FROM processo p 
			INNER JOIN orgao o on o.id_orgao=p.id_orgao 
			WHERE p.id_orgao IN(
			SELECT o.id_orgao 
			FROM orgao o 
			WHERE o.id_orgao=:id_orgao)", [
				":id_orgao"=>$this->getid_orgao()
			]);
		} else {
			return $sql->select("SELECT p.id_processo, p.numero_processo, p.id_tipo_processo, p.id_orgao, o.nome_orgao, p.data_inicio, p.nome_processo, p.assunto_processo FROM processo p 
			INNER JOIN orgao o on o.id_orgao=p.id_orgao 
			WHERE p.id_orgao NOT IN(
			SELECT o.id_orgao 
			FROM orgao o 
			WHERE o.id_orgao=:id_orgao)", [
				":id_orgao"=>$this->getid_orgao()
			]);
		}
	}

	public function saveProcesso(){

		$sql = new Sql();
		$results = $sql->select("CALL salvarprocesso (:numero_processo, :id_orgao, :id_tipo_processo, :data_inicio, :nome_processo, :assunto_processo, :proc_data_entrada, :id_orgao_movimento, :observacoes)", array(

			":numero_processo"=>$this->getnumero_processo(),
			":id_orgao"=>$this->getid_orgao(),
			":id_tipo_processo"=>$this->getid_tipo_processo(),
			":data_inicio"=>$this->getdata_inicio(),
			":nome_processo"=>$this->getnome_processo(),
			":assunto_processo"=>$this->getassunto_processo(),
			":proc_data_entrada"=>$this->getproc_data_entrada(),
			":id_orgao_movimento"=>$this->getid_orgao_movimento(),
			":observacoes"=>$this->getobservacoes()
		));

		$this->setData($results[0]);

	}

	public function saveMovimentoProcesso(){

		$sql = new Sql();
		$sql->select("CALL salvarmovimentoprocesso (:id_processo,:id_tipo_movimento,:proc_data_entrada,:id_orgao_movimento,:observacoes)", array(

			":id_processo"=>$this->getid_processo(),
			":id_tipo_movimento"=>$this->getid_tipo_movimento(),
			":proc_data_entrada"=>$this->getproc_data_entrada(),
			":id_orgao_movimento"=>$this->getid_orgao_movimento(),
			":observacoes"=>$this->getobservacoes()
		));

	}

	public function updateProcesso(){

		$sql = new Sql();
		$sql->query("UPDATE processo p SET p.numero_processo=:numero_processo, p.id_orgao=:id_orgao, p.id_tipo_processo=:id_tipo_processo, p.data_inicio=:data_inicio, p.nome_processo=:nome_processo, p.assunto_processo=:assunto_processo WHERE p.id_processo=:id_processo", array(
			":id_processo"=>$this->getid_processo(),
			":numero_processo"=>$this->getnumero_processo(),
			":id_orgao"=>$this->getid_orgao(),
			":id_tipo_processo"=>$this->getid_tipo_processo(),
			":data_inicio"=>$this->getdata_inicio(),
			":nome_processo"=>$this->getnome_processo(),
			":assunto_processo"=>$this->getassunto_processo()
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