<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class Socios implements Crud{

    public static function getAll(){
     
    }

    public static function insert($socio){
	    $mysqli = Database::getInstance(1);
      $query=<<<sql
      INSERT INTO socios(null, id_categoria, nombre, apellido_paterno, apellido_materno, id_prefijo, nombre_constacia, rfc, calle, numero_ext, numero_int,colonia,del_o_municipio,cp,id_estado,lada,telefono,email,contrasena)
      VALUES(:id_categoria, :nombre, :apellido_paterno, :apellido_materno, :id_prefijo, :nombre_constacia, :rfc, :calle, :numero_ext, :numero_int, :colonia, :del_o_municipio, :cp, :id_estado, :lada, :telefono, :email, :contrasena);
sql;

        $parametros = array(
          ':id_categoria' => $socio->_id_categoria,
          ':nombre'=>$socio->_nombre_bu,
          ':apellido_paterno' => $socio->_apellido_paterno,
          ':apellido_materno' => $socio->_apellido_materno,
          ':id_prefijo'=>$socio->_id_prefijo,
          ':nombre_constacia'=>$socio->_nombre_constancia,
          ':rfc'=>$socio->_rfc,
          ':calle'=>$socio->_calle,
          ':numero_ext'=>$socio->_numero_ext,
          ':numero_int'=>$socio->_numero_int,
          ':colonia'=>$socio->_colonia,
          ':del_o_municipio'=>$socio->_del_o_municipio,
          ':cp'=>$socio->_cp,
          ':id_estado'=>$socio->_id_estado,
          ':lada'=>$socio->_lada,
          ':telefono'=>$socio->_telefono,
          ':email'=>$socio->_email,
          ':contrasena'=>$socio->_contrasena
        );

        $id = $mysqli->insert($query,$parametros);
        $accion = new \stdClass();
        $accion->_sql= $query;
        $accion->_parametros = $parametros;
        $accion->_id = $id;
        
        return $id;
    }

    public static function update($docuemto){
     
    }

    public static function delete($id){
      
    }



    public static function getById($id){
     
    }
}
