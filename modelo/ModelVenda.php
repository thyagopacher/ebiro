<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelVenda
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Venda.php");

class ModelVenda {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Venda $venda){
        $this->conectar();
        $query = "insert into venda (nome, )"
                . " values('".$venda->getNome()."', '".$venda->getValor()."', '".$venda->getCodcategoria()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Venda $venda){
        $this->conectar();
        $query = "update venda set nome = '".$venda->getNome()."', "
                . " valor = '".$venda->getValor()."'"
                . " where codvenda = '".$venda->getCodvenda()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codvenda){
        $this->conectar();
        $query = "delete from venda where codvenda = '$codvenda'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codvenda){
        $this->conectar();
        $query = "select v.*, (select nome from pessoa where codpessoa = v.codcliente) as cliente from venda v where codvenda = '$codvenda'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select v.*, (select nome from pessoa where codpessoa = v.codcliente) as cliente from venda v from venda v where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select v.*,(select nome from pessoa where codpessoa = v.codcliente) as cliente  from venda v";
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
