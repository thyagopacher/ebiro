<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelConfiguracao
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Configuracao.php");

class ModelConfiguracao {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Configuracao $configuracao){
        $this->conectar();
        $query = "insert into configuracao (parcelasjuro, fretecorreio,lucro, quemsomos, descricao, palavrachave, codempresa, emailpagseguro, cortopo, corrodape, corbody)"
                . " values('".$configuracao->getParcelasjuro()."', ".$configuracao->getFretecorreio()."',".$configuracao->getLucro()."',".$configuracao->getQuemsomos()."', '".$configuracao->getDescricao()."',"
                . " '".$configuracao->getPalavrachave()."', '1', '".$configuracao->getEmailpagseguro()."',"
                . " '".$configuracao->getCortopo()."', '".$configuracao->getCorrodape()."', '".$configuracao->getCorbody()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Configuracao $configuracao){
        $this->conectar();
        $query = "update configuracao set parcelasjuro = '".$configuracao->getParcelasjuro()."', fretecorreio = '".$configuracao->getFretecorreio()."', lucro = '".$configuracao->getLucro()."', palavrachave = '".$configuracao->getPalavrachave()."', descricao = '".$configuracao->getDescricao()."', "
                . " quemsomos = '".$configuracao->getQuemsomos()."', codempresa = '".$configuracao->getCodempresa()."',"
                . " emailpagseguro = '".$configuracao->getEmailpagseguro()."', cortopo = '".$configuracao->getCortopo()."',"
                . " corrodape = '".$configuracao->getCorrodape()."', corbody = '".$configuracao->getCorbody()."'"
                . " where codconfiguracao = '".$configuracao->getCodconfiguracao()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codconfiguracao){
        $this->conectar();
        $query = "delete from configuracao where codconfiguracao = '$codconfiguracao'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codconfiguracao){
        $this->conectar();
        $query = "select * from configuracao where codconfiguracao = '$codconfiguracao'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarQuemsomos($quemsomos){
        $this->conectar();
        $query = "select b.* from configuracao b where quemsomos like '%$quemsomos%' order by quemsomos";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from configuracao order by quemsomos";
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
