<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCorProduto
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/CorProduto.php");

class ModelCorProduto {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(CorProduto $corproduto){
        $this->conectar();
        $query = "insert into corproduto (codcor, codproduto)"
                . " values('".$corproduto->getCodcor()."', '".$corproduto->getCodproduto()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(CorProduto $corproduto){
        $this->conectar();
        $query = "update corproduto set codcor = '".$corproduto->getCodcor()."', "
                . " codproduto = '".$corproduto->getCodproduto()."'"
                . " where codcorproduto = '".$corproduto->getCodcorproduto()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcorproduto){
        $this->conectar();
        $query = "delete from corproduto where codcorproduto = '$codcorproduto'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcorproduto){
        $this->conectar();
        $query = "select * from corproduto where codcorproduto = '$codcorproduto'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarCodProduto($codproduto){
        $this->conectar();
        $query = "select cp.*,"
                . "(select valor from cor where codcor = cp.codcor) as valor,"
                . "(select nome from cor where codcor = cp.codcor) as nome"
                . " from corproduto cp where codproduto = '$codproduto'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }          
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select c.* "
                . "  from cor p";
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
