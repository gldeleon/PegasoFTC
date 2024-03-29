<?php

/*Clase para acceder a datos*/
    abstract class database{
    	private static $usr = "SYSDBA";
		private static $pwd = "masterkey";
		private $cnx;
		protected $query;
		//private $host = "C:\\Program Files (x86)\\Common Files\\Aspel\\Sistemas Aspel\\SAE6.00\\Empresa01\\Datos\\SAE50EMPRE01.FDB";/*Editar según la ubicación de la base de datos*/
		private $host = "C:\\xampp\\htdocs\\pegaso\\bd\\SAE50EMPRE01.FDB";/*Editar según la ubicación de la base de datos*/
		//private $host = "C:\\Program Files\\Common Files\\Aspel\\Sistemas Aspel\\SAE5.00\\Empresa01\\Datos\\SAE50EMPRE01.FDB";
		
		#Abre la conexión a la base de datos
		private function AbreCnx(){
			$this->cnx = ibase_connect($this->host, self::$usr, self::$pwd);
		}
		
		#Cierra la conexion a la base de datos
		private function CierraCnx(){
			ibase_close($this->cnx);
		}
		
		#Ejecuta un query simple del tipo INSERT, DELETE, UPDATE
		protected function EjecutaQuerySimple(){
			$this->AbreCnx();
			$rs = ibase_query($this->cnx, $this->query);
			return $rs;
			$this->CierraCnx();
		}
		
		#Ejecuta query de tipo SELECT
		protected function QueryObtieneDatos(){
			$this->AbreCnx();
			$rs = ibase_query($this->cnx, $this->query);
			return $this->FetchAs($rs);
			//var_dump($r);			
			$this->CierraCnx();
		}
				
		#Obtiene la cantidad de filas afectadas en BD
		function NumRows($result){
		if(!is_resource($result)) return false;
		return ibase_fetch_row($result);
		}
		
		#Regresa arreglo de datos asociativo, para mejor manejo de la informacion
		function FetchAs($result){
			if(!is_resource($result)) return false;
				return ibase_fetch_assoc($result);
		}
		 
    }
?>