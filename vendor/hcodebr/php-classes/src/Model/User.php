<?php 
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;


class User extends Model{

	const SESSION = "User";

	
	public static function getFromSession()
	{

		$user = new User();

		if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['id_usuario'] > 0) {

			$user->setData($_SESSION[User::SESSION]);

		}

		return $user;

	}

	public static function getNivelFromSession()
	{

		$nivel = new User();

		if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['id_nivel_usuario'] > 0) {

			$nivel->get((int)$_SESSION[User::SESSION]['id_nivel_usuario']);

		}

		return $nivel;

	}


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

	public function saveOrgao()
	{

		$sql = new Sql();

		$sql->query("INSERT into orgao values (NULL, :nome_orgao, :id_hierarquia_orgao)", array(
			":nome_orgao"=>$this->getnome_orgao(),
			":id_hierarquia_orgao"=>$this->getid_hierarquia_orgao()
		));

	}

	public function updateUsuario()
	{

		$sql = new Sql();

		$sql->query("UPDATE usuario u SET u.nome_usuario=:nome_usuario, u.cpf=:cpf, u.email=:email, u.id_orgao=:id_orgao, u.id_nivel_usuario=:id_nivel_usuario, u.id_situacao_usuario=:id_situacao_usuario where u.id_usuario=:id_usuario", [
			":id_usuario"=>$this->getid_usuario(),
			":nome_usuario"=>$this->getnome_usuario(),
			":cpf"=>$this->getcpf(),
			":email"=>$this->getemail(),
			":id_orgao"=>$this->getid_orgao(),
			":id_nivel_usuario"=>$this->getid_nivel_usuario(),
			":id_situacao_usuario"=>$this->getid_situacao_usuario()
		]);

	}

	public function updatePassword()
	{

		$sql = new Sql();

		$sql->query("UPDATE usuario u SET u.senha=:senha where u.id_usuario=:id_usuario", [
			":id_usuario"=>$this->getid_usuario(),
			":senha"=>User::getPasswordHash($this->getsenha())
		]);

	}

	public function updateOrgao()
	{

		$sql = new Sql();

		$sql->query("UPDATE orgao o SET o.nome_orgao=:nome_orgao, o.id_hierarquia_orgao=:id_hierarquia_orgao where o.id_orgao=:id_orgao", [
			":id_orgao"=>$this->getid_orgao(),
			":nome_orgao"=>$this->getnome_orgao(),
			":id_hierarquia_orgao"=>$this->getid_hierarquia_orgao()
		]);

	}


	public function listUsuarioById($id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT u.id_usuario, u.nome_usuario, u.cpf, u.email, u.id_orgao, o.nome_orgao, u.id_nivel_usuario, nu.nivel, u.id_situacao_usuario, su.situacao FROM usuario u inner join orgao o on o.id_orgao=u.id_orgao inner join nivel_usuario nu on nu.id_nivel_usuario=u.id_nivel_usuario inner join situacao_usuario su on su.id_situacao_usuario=u.id_situacao_usuario where u.id_usuario = :id_usuario", array(
			":id_usuario"=>$id_usuario
		));

		$this->setData($results[0]);

	}

	public static function listOrgaoByUsuarioActive()
	{

		$sql = new Sql();

		return $sql->select("SELECT distinct o.* FROM orgao o INNER JOIN usuario u on u.id_orgao=o.id_orgao");

	}

	public function getOrgaobyId($id_orgao){

		$sql = new Sql();

		$results = $sql->select("SELECT o.id_orgao, o.nome_orgao FROM orgao o INNER JOIN usuario u on u.id_orgao=o.id_orgao WHERE o.id_orgao=:id_orgao", array(

			":id_orgao"=>$id_orgao

		));

		$this->setData($results[0]);
	}

	public function listOrgaobyId($id_orgao)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT o.id_orgao, o.nome_orgao, o.id_hierarquia_orgao, ho.tipo_hierarquia FROM orgao o INNER JOIN hierarquia_orgao ho on ho.id_hierarquia_orgao=o.id_hierarquia_orgao where o.id_orgao=:id_orgao", [
			":id_orgao"=>$id_orgao
		]);

		$this->setData($results[0]);

	}

	public function listUsuarioByOrgao($related = true)
	{

		$sql = new Sql();

		if ($related === true){
		return $sql->select("SELECT u.id_usuario, u.nome_usuario, u.cpf, o.nome_orgao, nu.nivel, su.situacao FROM usuario u inner join orgao o on o.id_orgao=u.id_orgao inner join nivel_usuario nu on nu.id_nivel_usuario=u.id_nivel_usuario inner join situacao_usuario su on su.id_situacao_usuario=u.id_situacao_usuario WHERE o.id_orgao IN (SELECT o.id_orgao FROM orgao o INNER JOIN usuario u on u.id_orgao = o.id_orgao where u.id_orgao=:id_orgao) group BY u.id_usuario", [
			":id_orgao"=>$this->getid_orgao()
		]);

		} else {
		return $sql->select("SELECT u.id_usuario, u.nome_usuario, u.cpf, o.nome_orgao, nu.nivel, su.situacao FROM usuario u inner join orgao o on o.id_orgao=u.id_orgao inner join nivel_usuario nu on nu.id_nivel_usuario=u.id_nivel_usuario inner join situacao_usuario su on su.id_situacao_usuario=u.id_situacao_usuario WHERE o.id_orgao NOT IN (SELECT o.id_orgao FROM orgao o INNER JOIN usuario u on u.id_orgao = o.id_orgao where u.id_orgao=:id_orgao) group BY u.id_usuario", [
			":id_orgao"=>$this->getid_orgao()
		]);			
		}

	}


	public static function listAllUsuario()
	{

		$sql = new Sql();

		return $sql->select("SELECT u.id_usuario, u.nome_usuario, u.cpf, o.nome_orgao, nu.nivel, su.situacao FROM usuario u inner join orgao o on o.id_orgao=u.id_orgao inner join nivel_usuario nu on nu.id_nivel_usuario=u.id_nivel_usuario inner join situacao_usuario su on su.id_situacao_usuario=u.id_situacao_usuario ORDER BY u.id_usuario");

	}

	public static function ShowUserSession()
	{

		$sql = new Sql();

		return $sql->select("SELECT u.id_usuario, u.nome_usuario, u.cpf, o.nome_orgao, nu.nivel, su.situacao FROM usuario u inner join orgao o on o.id_orgao=u.id_orgao inner join nivel_usuario nu on nu.id_nivel_usuario=u.id_nivel_usuario inner join situacao_usuario su on su.id_situacao_usuario=u.id_situacao_usuario WHERE u.id_usuario =:id_usuario ORDER BY u.id_usuario", array (
			":id_usuario"=>(int)$_SESSION[User::SESSION]['id_usuario']
		));

	}

	public static function listAllOrgao(){

		$sql = new Sql();
		return $sql->select("SELECT o.id_orgao, o.nome_orgao, o.id_hierarquia_orgao, hq.tipo_hierarquia FROM orgao o INNER JOIN hierarquia_orgao hq ON hq.id_hierarquia_orgao=o.id_hierarquia_orgao ORDER BY o.nome_orgao");

	}

	public static function listAllProcessoOrgaoActive(){

		$sql = new Sql();
		return $sql->select("SELECT o.* FROM orgao o INNER JOIN processo p on p.id_orgao=o.id_orgao INNER JOIN tipo_processo tp on tp.id_tipo_processo=p.id_tipo_processo INNER JOIN processo_documento pd on pd.id_processo_documento=p.id_processo_documento INNER JOIN movimento m on m.id_processo_documento=pd.id_processo_documento where m.id_orgao =:orgaolog", array (
			":orgaolog"=>(int)$_SESSION[User::SESSION]['id_orgao']
		));

	}

	public static function listAllDocumentoOrgaoActive(){

		$sql = new Sql();
		return $sql->select("SELECT distinct o.* FROM orgao o INNER JOIN documento d on d.id_orgao=o.id_orgao INNER JOIN processo_documento pd on pd.id_processo_documento=d.id_processo_documento INNER JOIN movimento m on m.id_processo_documento=pd.id_processo_documento where m.id_orgao=:orgaolog", array(
			":orgaolog"=>(int)$_SESSION[User::SESSION]['id_orgao']
		));

	}

	public static function listAllOrgaoIntern(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM orgao o where o.id_hierarquia_orgao=1 ORDER BY o.nome_orgao");

	}

	public static function listAllTipo(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tipo_processo ORDER BY tipo_processo.tipo_processo");

	}

	public static function listAllTipoDocumento(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tipo_documento ORDER BY tipo_documento.tipo_documento");

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

	public static function listAllHierarquiaOrgao(){

		$sql = new Sql();
		return $sql->select("select * from hierarquia_orgao");

	}

}
?>