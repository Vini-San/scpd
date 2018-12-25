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
		return $sql->select("SELECT * FROM processo p INNER JOIN orgao o on o.id_orgao=o.id_orgao INNER JOIN tipo_processo tp on tp.id_tipo_processo=p.id_tipo_processo INNER JOIN processo_documento pd on pd.id_processo_documento=p.id_processo_documento GROUP BY p.id_processo");

	}

	public static function listAllOrgao(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM orgao ORDER BY orgao.id_hierarquia_orgao");

	}

	public function saveProcess(){

		$sql = new Sql();
		$results = $sql->query("INSERT INTO processo values(null, :numero_processo, :id_orgao, :id_tipo_processo, :data_inicio, :nome_processo, :assunto_processo; id_processo_documento)", array(

			":numero_processo"=>$this->getnumero_processo(),
			":id_orgao"=>$this->getid_orgao(),
			":id_tipo_processo"=>$this->getid_tipo_processo(),
			":data_inicio"=>$this->getdata_inicio(),
			":nome_processo"=>$this->getnome_processo(),
			":assunto_processo"=>$this->getassunto_processo(),
			":id_processo_documento"=>$this->getid_processo_documento()

		));

		$this->setData($results[0]);

	}

	public function get($id_processo){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM processo p INNER JOIN orgao o on o.id_orgao=o.id_orgao INNER JOIN tipo_processo tp on tp.id_tipo_processo=p.id_tipo_processo INNER JOIN processo_documento pd on pd.id_processo_documento=p.id_processo_documento WHERE p.id_processo=:id_processo GROUP BY p.id_processo", array(

			":id_processo"=>$id_processo

		));

		$this->setData($results[0]);
	}

	public function update(){

		$sql = new Sql();
		$results = $sql->select("CALL sp_usersupdate_save(:iduser, :desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
			":iduser"=>$this->getiduser(),
			":desperson"=>$this->getdesperson(),
			":deslogin"=>$this->getdeslogin(),
			":despassword"=>$this->getdespassword(),
			":desemail"=>$this->getdesemail(),
			":nrphone"=>$this->getnrphone(),
			":inadmin"=>$this->getinadmin()

		));

		$this->setData($results[0]);

	}

	public function delete(){

		$sql = new Sql();

		$sql->query("CALL sp_users_delete (:iduser)",array(
			":iduser"=>$this->getiduser()
		));

	}

}


 ?>