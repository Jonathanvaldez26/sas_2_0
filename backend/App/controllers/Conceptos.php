<?php

namespace App\controllers;

defined("APPPATH") or die("Access denied");

use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \Core\Controller;
use \App\models\Conceptos as ConceptosDao;

class Conceptos extends Controller
{
    private $_contenedor;

    function __construct()
    {
        parent::__construct();
        $this->_contenedor = new Contenedor;
        View::set('header', $this->_contenedor->header());
        View::set('footer', $this->_contenedor->footer());
        // if (Controller::getPermisosUsuario($this->__usuario, "seccion_pickup", 1) == 0)
        //     header('Location: /Principal/');
    }

    public function getUsuario()
    {
        return $this->__usuario;
    }

    public function index()
    {
        $extraFooter = <<<html
          <script>
          $(document).ready(function(){
            $('#pickup-list').DataTable({
                "drawCallback": function( settings ) {
                  $('.current').addClass("btn bg-gradient-danger btn-rounded").removeClass("paginate_button");
                  $('.paginate_button').addClass("btn").removeClass("paginate_button");
                  $('.dataTables_length').addClass("m-4");
                  $('.dataTables_info').addClass("mx-4");
                  $('.dataTables_filter').addClass("m-4");
                  $('input').addClass("form-control");
                  $('select').addClass("form-control");
                  $('.previous.disabled').addClass("btn-outline-danger opacity-5 btn-rounded mx-2");
                  $('.next.disabled').addClass("btn-outline-danger opacity-5 btn-rounded mx-2");
                  $('.previous').addClass("btn-outline-danger btn-rounded mx-2");
                  $('.next').addClass("btn-outline-danger btn-rounded mx-2");
                  $('a.btn').addClass("btn-rounded");
                },
                "language": {
                 
                     "sProcessing":     "Procesando...",
                     "sLengthMenu":     "Mostrar _MENU_ registros",
                     "sZeroRecords":    "No se encontraron resultados",
                     "sEmptyTable":     "Ningún dato disponible en esta tabla",
                     "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                     "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                     "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                     "sInfoPostFix":    "",
                     "sSearch":         "Buscar:",
                     "sUrl":            "",
                     "sInfoThousands":  ",",
                     "sLoadingRecords": "Cargando...",
                     "oPaginate": {
                         "sFirst":    "Primero",
                         "sLast":     "Último",
                         "sNext":     "Siguiente",
                         "sPrevious": "Anterior"
                     },
                     "oAria": {
                         "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                     }
                 }
              });
          });
        </script>
html;
    }

    public function ConceptosAdd()
    {
        $data = new \stdClass();

        $ano = MasterDom::getData('ano');
        $nombre_concepto = MasterDom::getData('nombre_concepto');
        $id_moneda = MasterDom::getData('id_moneda');
        $precio = MasterDom::getData('precio');
        $iva = MasterDom::getData('iva');
        $observaciones = MasterDom::getData('observaciones');
        $al_corriente = MasterDom::getData('al_corriente');
        $id_categoria = MasterDom::getData('id_categoria');
        $id_clave_produc_serv = MasterDom::getData('id_clave_produc_serv');
        $unidad = MasterDom::getData('unidad');

        $data->_ano = $ano;
        $data->_nombre_concepto = $nombre_concepto;
        $data->_id_moneda = $id_moneda;
        $data->_precio = $precio;
        $data->_iva = $iva;
        $data->_observaciones = $observaciones;
        $data->_al_corriente = $al_corriente;
        $data->_id_categoria =  $id_categoria;
        $data->_id_clave_produc_serv = $id_clave_produc_serv;
        $data->_unidad = $unidad;

        $id = ConceptosDao::insert($data);
        if ($id >= 1) {
            // $this->alerta($id,'add');
            echo "success";
        } else {
            // header('Location: /PickUp');
            echo "error";
        }
    }



    public function Actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = new \stdClass();

            $id_concepto = MasterDom::getData('id_concepto');
            $ano = MasterDom::getData('ano');
            $nombre_concepto = MasterDom::getData('nombre_concepto');
            $id_moneda = MasterDom::getData('id_moneda');
            $precio = MasterDom::getData('precio');
            $iva = MasterDom::getData('iva');
            $observaciones = MasterDom::getData('observaciones');
            $al_corriente = MasterDom::getData('al_corriente');
            $id_categoria = MasterDom::getData('id_categoria');
            $id_clave_produc_serv = MasterDom::getData('id_clave_produc_serv');
            $unidad = MasterDom::getData('unidad');

            $data->_id_concepto = $id_concepto;
            $data->_ano = $ano;
            $data->_nombre_concepto = $nombre_concepto;
            $data->_id_moneda = $id_moneda;
            $data->_precio = $precio;
            $data->_iva = $iva;
            $data->_observaciones = $observaciones;
            $data->_al_corriente = $al_corriente;
            $data->_id_categoria =  $id_categoria;
            $data->_id_clave_produc_serv = $id_clave_produc_serv;
            $data->_unidad = $unidad;

            $id = ConceptosDao::update($data);
            if ($id) {
                echo "success";
                //header("Location: /Home");
            } else {
                echo "fail";
                // header("Location: /Home/");
            }
        } else {
            echo 'fail REQUEST';
        }
    }

   

    function generateRandomString($length = 6)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
