<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu {
	private $arr_menu;
	function cargar($menu){
	$this->arr_menu = $menu;
	
	}
	public function crearMenu(){
	$menu2 = "<nav><ul>";
	foreach($this->arr_menu as $opcion){
		$menu2 .= "<li>".$opcion."</li>";
	}

	$menu2 .= "</ul></nav>";
	return $menu2;
	
	}

}


?>