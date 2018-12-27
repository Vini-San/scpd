<?php 
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;


class User extends Model{

	const SESSION = "User";

	public static function login($login,$password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE cpf = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results) === 0){

			throw new \Exception("Usuário inexistente ou senha inválida");
			
		}

		$data = $results[0];

		if(password_verify($password, $data["senha"]) === true){

			$user = new User();

			$user->setData($data);

			$_SESSION[User::SESSION] = $user ->getValues();

			return $user;

		} else {

			throw new \Exception("Usuário inexistente ou senha inválida");

		}
	}

	public static function logout(){

		$_SESSION[User::SESSION] = NULL;
		
	}

	public static function verifyLogin(){

		if (
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]
		) {

			header("Location: /admin/login");
			exit;

		}

	}

	public static function listAll(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM processo p INNER JOIN orgao o on o.id_orgao=p.id_orgao INNER JOIN tipo_processo tp on tp.id_tipo_processo=p.id_tipo_processo INNER JOIN processo_documento pd on pd.id_processo_documento=p.id_processo_documento GROUP BY p.id_processo");

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

	public function getProcessoById($id_processo){

		$sql = new Sql();

		$results = $sql->select("SELECT p.id_processo, p.numero_processo, p.id_tipo_processo, tp.tipo_processo, p.id_orgao, o.nome_orgao, p.data_inicio, p.nome_processo, p.assunto_processo FROM processo p INNER JOIN orgao o on o.id_orgao=p.id_orgao INNER JOIN tipo_processo tp on tp.id_tipo_processo=p.id_tipo_processo INNER JOIN processo_documento pd on pd.id_processo_documento=p.id_processo_documento WHERE p.id_processo=:id_processo GROUP BY p.id_processo", array(

			":id_processo"=>$id_processo

		));

		$this->setData($results[0]);
	}

	public static function listAllOrgao(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM orgao ORDER BY orgao.nome_orgao");

	}

	public static function listAllTipo(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tipo_processo ORDER BY tipo_processo.tipo_processo");

	}

	public function updateProcesso(){

		$sql = new Sql();
		$results = $sql->query("UPDATE processo p SET p.numero_processo=:numero_processo, p.id_orgao=:id_orgao, p.id_tipo_processo=:id_tipo_processo, p.data_inicio=:data_inicio, p.nome_processo=:nome_processo, p.assunto_processo=:assunto_processo WHERE p.id_processo=:id_processo", array(
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

	public function delete(){

		$sql = new Sql();

		$sql->query("CALL sp_users_delete (:iduser)",array(
			":iduser"=>$this->getiduser()
		));

	}

}


 ?>