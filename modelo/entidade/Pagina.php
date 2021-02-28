<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagina
 *
 * @author ebiro_2
 */
class Pagina {
    
    private $codpagina;
    private $titulo;
    private $texto;
    
    public function getCodpagina(){return $this->codpagina;}
    public function setCodpagina($codpagina){$this->codpagina = $codpagina;}       
    public function getTitulo(){return $this->titulo;}
    public function setTitulo($titulo){$this->titulo = $titulo;}
    public function getTexto(){return $this->texto;}
    public function setTexto($texto){$this->texto = $texto;}   
     
}

?>
