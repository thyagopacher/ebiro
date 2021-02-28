<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelItemVenda
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/ItemVenda.php");

class ModelItemVenda {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(ItemVenda $itemvenda){
        $this->conectar();
        $query = "insert into itemvenda (codproduto, codvenda)"
                . " values('".$itemvenda->getCodproduto."', '".$itemvenda->getCodvenda."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(ItemVenda $itemvenda){
        $this->conectar();
        $query = "update itemvenda set codproduto = '".$itemvenda->getCodproduto()."', "
                . " codvenda = '".$itemvenda->getCodvenda()."' "
                . " where coditem = '".$itemvenda->getCoditemvenda()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($coditem){
        $this->conectar();
        $query = "delete from itemvenda where coditem = '$coditem'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($coditem){
        $this->conectar();
        $query = "select v.* from itemvenda v where coditem = '$coditem'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select v.* from itemvenda v from itemvenda v where nome like '%$nome%' order by coditem asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select v.* from itemvenda v";
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
