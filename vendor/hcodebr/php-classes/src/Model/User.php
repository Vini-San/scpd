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

			//throw new \Exception("Usuário inexistente ou senha inválida");
			//session_destroy();
			header("Location: /admin/login");
			die();
			
		}

		$data = $results[0];

		if(password_verify($password, $data["senha"]) === true){

			$user = new User();

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		} else {

			//throw new \Exception("Usuário inexistente ou senha inválida");
			//session_destroy();
			header("Location: /admin/login");
			die();

		}
	}

	public static function logout(){

		$_SESSION[User::SESSION] = NULL;
		die();
		
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

	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

	public function saveUsuario()
	{

		$sql = new Sql();

		$sql->select("CALL salvarusuario(:nome_usuario, :cpf, :email, :senha, :id_orgao, :id_nivel_usuario)", array(
			":nome_usuario"=>$this->getnome_usuario(),
			":cpf"=>$this->getcpf(),
			":email"=>$this->getemail(),
			":senha"=>User::getPasswordHash($this->getsenha()),
			":id_orgao"=>$this->getid_orgao(),
			":id_nivel_usuario"=>$this->getid_nivel_usuario()
		));

	}

	public function listUsuarioById($id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT u.id_usuario, u.nome_usuario, u.cpf, u.email, u.senha, u.id_orgao, o.nome_orgao, u.id_nivel_usuario, nu.nivel, u.id_situacao_usuario, su.situacao FROM usuario u inner join orgao o on o.id_orgao=u.id_orgao inner join nivel_usuario nu on nu.id_nivel_usuario=u.id_nivel_usuario inner join situacao_usuario su on su.id_situacao_usuario=u.id_situacao_usuario where u.id_usuario = :id_usuario", array(
			":id_usuario"=>$id_usuario
		));

		$this->setData($results[0]);

	}

	public static function listAllUsuario()
	{

		$sql = new Sql();

		return $sql->select("SELECT u.id_usuario, u.nome_usuario, u.cpf, o.nome_orgao, nu.nivel, su.situacao FROM usuario u inner join orgao o on o.id_orgao=u.id_orgao inner join nivel_usuario nu on nu.id_nivel_usuario=u.id_nivel_usuario inner join situacao_usuario su on su.id_situacao_usuario=u.id_situacao_usuario ORDER BY u.id_usuario");

	}

	public static function listAllOrgao(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM orgao ORDER BY orgao.nome_orgao");

	}

	public static function CountAllOrgao(){

		$sql = new Sql();
		return $sql->select("SELECT count(orgao.id_orgao) as nrorgao FROM orgao");

	}

	public static function listAllOrgaoActive(){

		$sql = new Sql();
		return $sql->select("SELECT distinct o.* FROM orgao o INNER JOIN processo p on p.id_orgao=o.id_orgao");

	}

	public static function listAllOrgaoIntern(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM orgao o where o.id_hierarquia_orgao=1 ORDER BY o.nome_orgao");

	}

	public static function listAllTipo(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tipo_processo ORDER BY tipo_processo.tipo_processo");

	}

	public static function listAllTipoMovimento(){

		$sql = new Sql();
		return $sql->select("select * from tipo_movimento");

	}

	public static function listAllNivelUsuario(){

		$sql = new Sql();
		return $sql->select("select * from nivel_usuario");

	}

	public static function listAllSituacaoUsuario(){

		$sql = new Sql();
		return $sql->select("select * from situacao_usuario");

	}


}


 ?>