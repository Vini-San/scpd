<?php 
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;


class ProcessoDocumento extends Model{

	

	public function getProcessoMovimentoById($id_processo){

		$sql = new Sql();

		$results = $sql->select("SELECT m.id_movimento, m.id_tipo_movimento, tm.tipo_movimento, m.proc_data_entrada, m.id_orgao, m.observacoes_proc_entrada, o.nome_orgao FROM movimento m INNER JOIN orgao o on o.id_orgao=m.id_orgao INNER JOIN tipo_movimento tm on tm.id_tipo_movimento=m.id_tipo_movimento INNER JOIN processo_documento pd on pd.id_processo_documento=m.id_processo_documento INNER JOIN processo p on p.id_processo_documento=pd.id_processo_documento where p.id_processo = :id_processo", array(

			":id_processo"=>$id_processo

		));

		$this->setData($results[0]);
	}



}


 ?>