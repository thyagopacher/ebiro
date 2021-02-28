<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelItemCompra
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/ItemCompra.php");

class ModelItemCompra {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(ItemCompra $itemcompra){
        $this->conectar();
        $query = "insert into itemcompra (codproduto, codcompra)"
                . " values('".$itemcompra->getCodproduto."', '".$itemcompra->getCodcompra."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(ItemCompra $itemcompra){
        $this->conectar();
        $query = "update itemcompra set codproduto = '".$itemcompra->getCodproduto()."', "
                . " codcompra = '".$itemcompra->getCodcompra()."' "
                . " where coditem = '".$itemcompra->getCoditemcompra()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($coditem){
        $this->conectar();
        $query = "delete from itemcompra where coditem = '$coditem'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($coditem){
        $this->conectar();
        $query = "select v.* from itemcompra v where coditem = '$coditem'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select v.* from itemcompra v from itemcompra v where nome like '%$nome%' order by coditem asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select v.* from itemcompra v";
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
