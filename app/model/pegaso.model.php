<?php
session_cache_limiter('private_no_expire');
require_once 'app/model/database.php';

/*Clase para hacer uso de database*/
class pegaso extends database{
	
	/*Comprueba datos de login*/
	function AccesoLogin($user, $pass){
$u = strtolower($user);
		$this->query = "SELECT USER_LOGIN, USER_PASS, USER_ROL
						FROM PG_USERS 
						WHERE USER_LOGIN = '$u' and USER_PASS = '$pass'"; /*Contraseña va encriptada con MD5*/
		  $log = $this->QueryObtieneDatos();
			if(count($log) > 0){
				/*Creamos variable de sesion*/
					$_SESSION['user'] = $log;
					//var_dump($_SESSION['user']);
					return $_SESSION['user'];				
			}else{
				return 0;
			}
	}
	function CompruebaRol($user){
		$this->query = "SELECT USER_ROL FROM PG_USERS WHERE USER_LOGIN = '$user'";/*Falta Tabla*/
		 $log = $this->QueryObtieneDatos();
			if(count($log) > 0){
				return $log;
			}else{
				return 0;
			}
			
	}
		
	function ObtieneReg(){
		$this->query = "SELECT COUNT(*)
  						FROM PG_USERS";
						
		$r = $this->QueryObtieneDatos();
		
		return	$r;
	}
	
	function NuevoUser($usuario, $contra, $email, $rol, $id){
		$fecha = date('d-m-Y');
		$u = strtolower($usuario);
		//echo $fecha;
		$this->query = "INSERT INTO PG_USERS VALUES ($id, '$u', '$contra', strtolower('$email'), '$fecha', 'alta', '$rol')";
		$rs = $this->EjecutaQuerySimple();
		//echo $rs;
		return $rs;
	}		
	
	function InsertaCompo($nombre, $duracion, $tipo, $status, $usuario){
		//$usuario = $_SESSION['user']; antes de insertar tomar el ultimo valor de id sumarle 1 e insertar
		$this->query = "INSERT INTO SEG_DOCUMENTOS VALUES (1, '$nombre', $duracion, $tipo, $usuario, " . getdate() . ", " . getdate() . ", $status)";
		$result = $this->EjecutaQuerySimple();
		return $result;
	}
	
	function ConsultaProd(){
		$this->query ="SELECT a.cve_art, e.nombre as Proveedor, d.costo, b.camplib7 as Nombre, b.camplib1 as Marca, c.cve_alm as Almacen, b.camplib8 as Categoria, 
						b.camplib2 as modelo, b.camplib3 as division, b.camplib4 as piezas, b.camplib9 as subcategoria, b.camplib10 as Codigo_Fabricante, b.camplib11 as Proveedor_Empaque, 
						b.camplib12 as Costo_x_Empaque, b.camplib13 as Unidad_de_Empaque, b.camplib14 as Piezas_por_empaque
						from inve01  a 
						left join inve_clib01 b on a.cve_art = b.cve_prod 
						left join mult01 c on a.cve_art = c.cve_art 
						left join prvprod01 d on a.cve_art = d.cve_art 
						left join prov01 e on d.cve_prov = e.clave 
						where c.cve_alm = '8'";
		
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
		}
		
		return 0;
	}
	
	
}
?>