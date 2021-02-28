<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCompra
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Compra.php");

class ModelCompra {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Compra $compra){
        $this->conectar();
        $query = "insert into compra (codfuncionario, data)"
                . " values('".$compra->getFuncionario()."', '".$compra->getValor()."', '".$compra->getCodcategoria()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Compra $compra){
        $this->conectar();
        $query = "update compra set nome = '".$compra->getNome()."', "
                . " valor = '".$compra->getValor()."', '".$compra->getCodcategoria()."'"
                . " where codcompra = '".$compra->getCodcompra()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcompra){
        $this->conectar();
        $query = "delete from compra where codcompra = '$codcompra'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcompra){
        $this->conectar();
        $query = "select v.*, (select nome from pessoa where codpessoa = v.codfuncionario) as funcionario from compra v where codcompra = '$codcompra'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select v.*, (select nome from pessoa where codpessoa = v.codfuncionario) as funcionario from compra v from compra v where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select v.*,(select nome from pessoa where codpessoa = v.codfuncionario) as funcionario  from compra v";
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
