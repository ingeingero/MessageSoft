<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paginacion {
    
    var $num_registros_por_pagina = "";
    var $page = "";
    var $total_registros = "";
    var $total_paginas  = "";
    var $nombre_funcion_recargar= "";

        
    function __construct($num_registros_por_pagina,$page,$total_registros,$nombre_funcion_recargar){
    $this->num_registros_por_pagina = $num_registros_por_pagina;
    $this->page = $page;
    $this->total_registros = $total_registros;
    $this->nombre_funcion_recargar = $nombre_funcion_recargar;
    $this->total_paginas = intval($this->total_registros/$this->num_registros_por_pagina); 
    }

    
    function ImprimirPaginacion(){
   
    
    $retornar="<div class='pagination'><ul>";
    //si la pagina actual es mayor que uno entonces pongo el boton Atras e Inicio
    if($this->page > 1){
        $ant = $this->page -1;
        $ini = 1;
        $funcion_recargar_ini = $this->nombre_funcion_recargar."($ini)";
        $funcion_recargar_ant = $this->nombre_funcion_recargar."($ant)";
        $retornar = $retornar ."<li ><a style='cursor:pointer' onclick='$funcion_recargar_ini'>Inicio</a></li>";
        $retornar = $retornar ."<li ><a style='cursor:pointer' onclick='$funcion_recargar_ant'>Ant</a></li>";
        }
    //Imprimo cada una de las paginas
    for($i=1; $i<=($this->total_paginas+1);$i++){
        $funcion_recargar = $this->nombre_funcion_recargar."($i)";
        if($this->page == $i) $class_paginacion = 'active';
        else $class_paginacion = '';
        $retornar = $retornar ."<li  style='cursor:pointer'  class='$class_paginacion' ><a style='cursor:ponter' title='Pagina $i' onclick='$funcion_recargar'>$i</a></li>";
      } 
    //Si la pagina es menor a la pagina final entonces pongo al boton de siguiente y el boton final.  
      if($this->page<($this->total_paginas+1)){
        
      $fin = $this->total_paginas+1;
      $sig = $this->page +1;
      $funcion_recargar_fin = $this->nombre_funcion_recargar."($fin)";
      $funcion_recargar_sig = $this->nombre_funcion_recargar."($sig)";
      $retornar = $retornar ."<li><a style='cursor:pointer' onclick='$funcion_recargar_sig'>Sig</a></li>";
      $retornar = $retornar ."<li ><a style='cursor:pointer' onclick='$funcion_recargar_fin'>Fin</a></li>";
      }
  
    $retornar = $retornar."</ul></div>";
    return $retornar;
   // return "felipe";
    
    
    }
  }




?>