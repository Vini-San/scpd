<?php 

use\Hcode\Model\User;

function formatDate($date)
{

	return date('d/m/Y', strtotime($date));

}

function getUserName()
{

	$usuario = User::getFromSession();

	return $usuario->getnome_usuario();

}

function getUserLevel()
{

	$usuario = User::getNivelFromSession();

	return $usuario->getnivel();

}



 ?>