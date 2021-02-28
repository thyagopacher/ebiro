<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelBanner
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Banner.php");

class ModelBanner {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Banner $banner){
        $this->conectar();
        $query = "insert into banner (linksite, imagem, posicao)"
                . " values('".$banner->getLink()."', '".$banner->getImagem()."', '".$banner->getPosicao()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Banner $banner){
        $this->conectar();
        $query = "update banner set linksite = '".$banner->getLink()."', imagem = '".$banner->getImagem()."', posicao = '".$banner->getPosicao()."' "
               . " where codbanner = '".$banner->getCodbanner()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codbanner){
        $this->conectar();
        $query = "delete from banner where codbanner = '$codbanner'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codbanner){
        $this->conectar();
        $query = "select * from banner where codbanner = '$codbanner'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarLink($link){
        $this->conectar();
        $query = "select b.* from banner b where linksite like '%$link%' order by codbanner";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from banner order by codbanner";
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
