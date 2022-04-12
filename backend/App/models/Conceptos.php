<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");
use \Core\Database;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;
class Conceptos implements Crud{
    public static function getAll(){
        $mysqli = Database::getInstance();
        $query=<<<sql
        
sql;
        return $mysqli->queryAll($query);
    }
    
    public static function getById($id){
        
    }
    public static function insert($data){
        $mysqli = Database::getInstance(1);
        $query=<<<sql
        INSERT INTO conceptos(ano, nombre_concepto,id_moneda, precio, iva, observaciones, al_corriente, id_categoria, id_clave_produc_serv, unidad)
        VALUES(:ano, :nombre_concepto,:id_moneda, :precio, :iva, :observaciones, :al_corriente, :id_categoria, :id_clave_produc_serv, :unidad);
sql;
            $parametros = array(

            ':ano'=>$data->_ano,
            ':nombre_concepto'=>$data->_nombre_concepto,
            ':id_moneda'=>$data->_id_moneda,
            ':precio'=>$data->_precio,
            ':iva'=>$data->_iva,
            ':observaciones'=>$data->_observaciones,
            ':al_corriente'=>$data->_al_corriente,
            ':id_categoria'=>$data->_id_categoria,
            ':id_clave_produc_serv'=>$data->_id_clave_produc_serv,
            ':unidad'=>$data->_unidad
            );

            $id = $mysqli->insert($query,$parametros);
            return $id;
    }
    
    public static function update($data){
        $mysqli = Database::getInstance(true);
        $query=<<<sql
        
sql;
        $parametros = array(
            
        );
        $accion = new \stdClass();
        $accion->_sql= $query;
        $accion->_parametros = $parametros;
        $accion->_id = $data->_administrador_id;
        return $mysqli->update($query,$parametros);
    }


    public static function delete($id){
        $mysqli = Database::getInstance(true);
        $query=<<<sql
        
sql;
        return $mysqli->delete($query);
    }
}