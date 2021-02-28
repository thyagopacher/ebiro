<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelConta
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Conta.php");

class ModelConta {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Conta $conta){
        $this->conectar();
        $query = "insert into conta (nome, valor, situacao, vencimento, periodo, parcela)"
                . " values('".$conta->getNome()."', '".$conta->getValor()."', '".$conta->getSituacao()."',"
                . " '".$conta->getVencimento()."', '".$conta->getPeriodo()."', '".$conta->getParcela()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Conta $conta){
        $this->conectar();
        $query = "update conta set nome = '".$conta->getNome()."', "
                . " valor = '".$conta->getValor()."', situacao = '".$conta->getSituacao()."',"
                . " vencimento = '".$conta->getVencimento()."', periodo = '".$conta->getPeriodo()."', parcela = '".$conta->getParcela()."'"
                . " where codconta = '".$conta->getCodconta()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codconta){
        $this->conectar();
        $query = "delete from conta where codconta = '$codconta'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codconta){
        $this->conectar();
        $query = "select * from conta where codconta = '$codconta'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select c.*"
                . " from conta c where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarSituacao($situacao){
        $this->conectar();
        $query = "select c.*"
                . " from conta c where situacao = '$situacao' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }      
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select c.* "
                . "  from conta c";
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
