<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");
use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \Core\Controller;
use \App\models\Categorias as CategoriasDao;

class Categorias extends Controller
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

    public function CategoriasAdd()
    {
        $data = new \stdClass();

        
        $nombre_categoria = MasterDom::getData('nombre_categoria');
        $status = MasterDom::getData('status');
        $fecha_alta = MasterDom::getData('fecha_alta');
        $es_socio = MasterDom::getData('es_socio');

        
        $data->_nombre_categoria = $nombre_categoria;
        $data->_status = $status;
        $data->_fecha_alta = $fecha_alta;
        $data->_es_socio = $es_socio;
      

        $id = CategoriasDao::insert($data);
        if ($id >= 1) {
            echo "success";
            // $this->alerta($id,'add');
            // header('Location: /PickUp');
        } else {
            echo "error";
            // header('Location: /PickUp');
            //var_dump($id);
        }
    }

    

    public function Actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $documento = new \stdClass();

            $id_categoria = MasterDom::getData('id_categoria');
            $nombre_categoria = MasterDom::getData('nombre_categoria');
            $status = MasterDom::getData('status');
            $fecha_alta = MasterDom::getData('fecha_alta');
            $es_socio = MasterDom::getData('es_socio');

            $documento->_id_categoria = $id_categoria;
            $documento->_nombre_categoria = $nombre_categoria;
            $documento->_status = $status;
            $documento->_fecha_alta = $fecha_alta;
            $documento->_es_socio = $es_socio;
            $id = CategoriasDao::update($documento);
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