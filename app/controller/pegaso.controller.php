<?php
//session_start();
session_cache_limiter('private_no_expire');
require_once('app/model/pegaso.model.php');

class pegaso_controller{
	/*Metodo que envía a login*/
	function Login(){
			$pagina = $this->load_templateL('Login');
			$html = $this->load_page('app/views/modules/m.login.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this->view_page($pagina);
	}
	
	function LoginA($user, $pass){
		$data = new pegaso;
			$rs = $data->AccesoLogin($user, $pass);
			//var_dump($rs);
				if(count($rs) > 0){					
					$r = $data->CompruebaRol($user);
					//var_dump($r);
					if($r['USER_ROL'] == 'administrador'){ /*Cambio el fetch_assoc cambia la forma en acceder al dato*/
						$this->MenuAdmin();
					}elseif($r['USER_ROL'] == 'administracion'){
						$this->MenuAd();
					}elseif($r['USER_ROL'] == 'usuario'){
						$this->MenuUsuario();
					}else{
						
						$e = "Error en acceso 1, favor de revisar usuario y/o contraseña";
						header('Location: index.php?action=login&e='.urlencode($e)); exit;
					}
				}else{
					$e = "Error en acceso 2, favor de revisar usuario y/o contraseña";
						header('Location: index.php?action=login&e='.urlencode($e)); exit;
				}
	}
	
	function Inicio(){
		if(isset($_SESSION['user'])){
			$o = $_SESSION['user'];
			if($o['USER_ROL'] == 'administrador'){
				$this->MenuAdmin();
			}elseif($o['USER_ROL'] == 'administracion'){
				$this->MenuAd();
			}else{
				$this->MenuUsuario();
			}
		}
	}
	
	/*Carga menu de administrador*/
	function MenuAdmin(){
		if(isset($_SESSION['user']) && $_SESSION['user']['USER_ROL'] == 'administrador'){
			$pagina = $this->load_template('Menu Admin');			
			$html = $this->load_page('app/views/modules/m.madmin.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function MenuAd(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.mad.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function MenuUsuario(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.muser.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	/*Carga modulo Asigna Flujo*/
	function AFlujo(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Asigna Flujo');
			$html = $this->load_page('app/views/pages/p.aflujo.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	/*Carga modulo Crea Flujo*/
	function CFlujo(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Asigna Flujo');
			$html = $this->load_page('app/views/pages/p.cflujo.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function AUsuarios(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Asigna Flujo');
			$html = $this->load_page('app/views/pages/p.ausuarios.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function CComp(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Asigna Flujo');
			$html = $this->load_page('app/views/pages/p.ccomp.php');
			ob_start();
			$rs = 
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function SFact(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Asigna Flujo');
			$html = $this->load_page('app/views/pages/p.sfact.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function AUsers(){
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Asigna Flujo');
			$html = $this->load_page('app/views/pages/p.ausers.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	/*Obtiene y carga el template*/
	function load_template($title='Sin Titulo'){
		$pagina = $this->load_page('app/views/master.php');
		$header = $this->load_page('app/views/sections/s.header.php');
		$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
		$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
		return $pagina;
	}
	
	/*Header para login*/
	function load_templateL($title='Sin Titulo'){
		$pagina = $this->load_page('app/views/master.php');
		$header = $this->load_page('app/views/sections/header.php');
		$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
		$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
		return $pagina;
	}
	
	function InsertaCcomp($nombre, $duracion, $tipo, $status, $usuario){
		if(isset($_SESSION['user'])){
			$data = new pegaso;
				$rs = $data->InsertaCompo($nombre, $duracion, $tipo, $status, $usuario);
				if(count($rs) > 0){
					$e = "Datos insertados correctamente";
					header('Location: index.php?action=ccomp&e='.urlencode($e)); exit;
				}else{
					$e = "Algo salió mal, favor de intentarlo nuevamente";
					header('Location: index.php?action=ccomp&e='.urlencode($e)); exit;
				}
				}else{
			$e = "Favor de Iniciar Sesión";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function InsertaUsuarioN($usuario, $contra, $email, $rol){
		$data = new pegaso;
		$html = '';
		$pagina = '';
		/*obtenemos el rol*/
		for ($i=0;$i<count($rol);$i++)    
			{     
			$roll = $rol[$i];    
			} 		
			$pagina=$this->load_template('Reporte');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.ausuarios.php');
		/*obtenemos numero de ultimo registro*/
		 $rs = $data->ObtieneReg();
		$id = (int) $rs["COUNT"] + 1; /*Forzamos a convertir la variable en entero*/		
		$nuser = $data->NuevoUser($usuario, $contra, $email, $roll, $id );
		//print_r($nuser);
		//var_dump($nuser);
		if($nuser != 0){
		ob_start(); 		 		
			include 'app/views/pages/p.ausuarios_result.php';
			/* hasta aqui podemos utilizar los datos almacenados en buffer desde la vista, por ejemplo el arreglo $exec 
			 * sin tener que aparecer el arreglo en la vista, ya que lo llama desde memoria (Y), de nuevo, es necesario incluir la vista
			 * desde la cual haremos uso de los datos y luego mandarlo en el replace content como la nueva vista*/
			$table = ob_get_clean(); 
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
		}else{
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>Algo salió mal</h2>', $pagina);
		}		
		$this->view_page($pagina);
	}
	
	function CCompVent(){
		if(isset($_SESSION['user'])){
			$data = new pegaso;
			$pagina=$this->load_template('Compra Venta');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.ccompvent.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		ob_start(); 
		//generamos consulta
		$exec = $data->ConsultaProd();
		if($exec != ''){
			include 'app/views/pages/p.ccompvent.php';
			/* hasta aqui podemos utilizar los datos almacenados en buffer desde la vista, por ejemplo el arreglo $exec 
			 * sin tener que aparecer el arreglo en la vista, ya que lo llama desde memoria (Y), de nuevo, es necesario incluir la vista
			 * desde la cual haremos uso de los datos y luego mandarlo en el replace content como la nueva vista*/
			$table = ob_get_clean(); 
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
		}else{
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>No hay resultados</h2>', $pagina);
		}		
		$this->view_page($pagina);
		
		}else{
			$e = "Favor de Iniciar Sesión";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function CSesion(){
		session_destroy($_SESSION['user']);
		session_unset($_SESSION['user']);
		$e = "Session Finalizada";
		header('Location: index.php?action=login&e='.urlencode($e)); exit;
	}
	/* METODO QUE CARGA UNA PAGINA DE LA SECCION VIEW Y LA MANTIENE EN MEMORIA
		INPUT
		$page | direccion de la pagina 
		OUTPUT
		STRING | devuelve un string con el codigo html cargado
	*/	
   private function load_page($page){
		return file_get_contents($page);
	}
   
   /* METODO QUE ESCRIBE EL CODIGO PARA QUE SEA VISTO POR EL USUARIO
		INPUT
		$html | codigo html
		OUTPUT
		HTML | codigo html		
	*/
   private function view_page($html){
		echo $html;
	}
   
   /* PARSEA LA PAGINA CON LOS NUEVOS DATOS ANTES DE MOSTRARLA AL USUARIO
		INPUT
		$out | es el codigo html con el que sera reemplazada la etiqueta CONTENIDO
		$pagina | es el codigo html de la pagina que contiene la etiqueta CONTENIDO
		OUTPUT
		HTML 	| cuando realiza el reemplazo devuelve el codigo completo de la pagina
	*/
   private function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){
		 return preg_replace($in, $out, $pagina);	 	
	}
}
?>