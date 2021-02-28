<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelRegraDesconto
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/RegraDesconto.php");

class ModelRegraDesconto {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(RegraDesconto $regradesconto){
        $this->conectar();
        $query = "insert into regradesconto (nome, valor, tipovalor, qtdmin, qtdmax)"
                . " values('".$regradesconto->getNome()."', '".$regradesconto->getValor()."','".$regradesconto->getTipovalor()."',"
                . " '".$regradesconto->getQtdmin()."','".$regradesconto->getQtdmax()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(RegraDesconto $regradesconto){
        $this->conectar();
        $query = "update regradesconto set nome = '".$regradesconto->getNome()."', valor = '".$regradesconto->getValor()."',"
                . " tipovalor = '".$regradesconto->getTipovalor()."', qtdmin = '".$regradesconto->getQtdmin()."',"
                . " qtdmax = '".$regradesconto->getQtdmax()."' where codregra = '".$regradesconto->getCodregra()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codregra){
        $this->conectar();
        $query = "delete from regradesconto where codregra = '$codregra'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codregra){
        $this->conectar();
        $query = "select * from regradesconto where codregra = '$codregra'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select * from regradesconto where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from regradesconto";
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
