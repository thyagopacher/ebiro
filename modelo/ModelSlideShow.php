<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelSlideShow
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/SlideShow.php");

class ModelSlideShow {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(SlideShow $slideshow){
        $this->conectar();
        $query = "insert into slideshow (titulo, texto, link, imagem)"
                . " values('".$slideshow->getTitulo()."', '".$slideshow->getTexto()."',"
                . " '".$slideshow->getLink()."', '".$slideshow->getImagem()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(SlideShow $slideshow){
        $this->conectar();
        $query = "update slideshow set titulo = '".$slideshow->getTitulo()."', "
                . " texto = '".$slideshow->getTexto()."', link = '".$slideshow->getLink()."',"
                . " imagem = '".$slideshow->getImagem()."'"
                . " where codslideshow = '".$slideshow->getCodslideshow()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codslideshow){
        $this->conectar();
        $query = "delete from slideshow where codslideshow = '$codslideshow'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codslideshow){
        $this->conectar();
        $query = "select s.* from slideshow s where codslideshow = '$codslideshow'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select s.* from slideshow s where titulo like '%$nome%' order by titulo asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select s.* from slideshow s";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }   
 
    public function procurar($query){
        $this->conectar();
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
}

?>
