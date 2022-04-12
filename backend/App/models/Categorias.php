<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");
use \Core\Database;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;
class Categorias implements Crud{

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
        INSERT INTO categorias(nombre_categoria, fecha_alta,es_socio, status )
        VALUES(:nombre_categoria, :fecha_alta,:es_socio, 1);
sql;
            $parametros = array(

            ':nombre_categoria'=>$data->_nombre_categoria,
            ':fecha_alta'=>$data->_fecha_alta,
            ':es_socio'=>$data->_es_socio
            );
            $id = $mysqli->insert($query,$parametros);
            return $id;

    }
    
    public static function update($data){
        
    }
    public static function delete($id){
       
    }
}