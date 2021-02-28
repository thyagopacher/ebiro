<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SlideShow
 *
 * @author ebiro_2
 */
class SlideShow {
    private $codslideshow;
    private $titulo;
    private $imagem;
    private $texto;
    private $link;

    public function getCodslideshow(){
        return $this->codslideshow;
    }
    public function setCodslideshow($codslideshow){
	$this->codslideshow = $codslideshow;                
    }    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function setTitulo($titulo){
	$this->titulo = $titulo;                 
    }    

    public function getImagem(){
        return $this->imagem;
    }
    
    public function setImagem($imagem){
	$this->imagem = $imagem;                
    }   

    public function getTexto(){
        return $this->texto;
    }
    
    public function setTexto($texto){
	$this->texto = $texto;                
    } 
    
    public function getLink(){
        return $this->link;
    }
    
    public function setLink($link){
	$this->link = $link;                
    }       

}

?>
