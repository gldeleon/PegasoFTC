<?php
session_start();
session_cache_limiter('private_no_expire');
require_once('app/controller/pegaso.controller.php');
$controller = new pegaso_controller;

//echo $_POST['nombre'];

if (isset($_POST['usuario'])){
	//$usuario = $_SESSION['user'];
	$controller->InsertaUsuarioN($_POST['usuario'], $_POST['contrasena'], $_POST['email'], $_POST['rol']);
	
}elseif(isset($_POST['user']) && isset($_POST['contra'])){
	$controller->LoginA(strtolower($_POST['user']), $_POST['contra']);
	//echo 'aqui estamos en el if';
	
}else{

//echo "no entro al if";

switch ($_GET['action']){
	case 'login':
		$controller->Login();
		break;
	case 'madmin':
		$controller->MenuAdmin();
		break;
	case 'facturas':
		$controller->Facturas();
		break;
	case 'inicio':
		$controller->Inicio();
		break;
	case 'aflujo':
		$controller->AFlujo();
		break;
	case 'cflujo':
		$controller->CFlujo();
		break;
	case 'ccomp':
		$controller->CComp();
		break;
	case 'sfact':
		$controller->SFact();
		break;
	case 'ausers':
		$controller->AUsers();
		break;
	case 'perfil':
		$controller->Perfil();
		break;
	case 'salir':
		$controller->CSesion();
		break;
	case 'ausuario':
		$controller->AUsuarios();
		break;
	case 'eusuarios':
		$controller->EUsuarios();
		break;
	case 'ccompvent':
		$controller->CCompVent();
		break;
	default:
		header('Location: index.php?action=login');
		break;
}
}
?>