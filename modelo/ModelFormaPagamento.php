<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelFormaPagamento
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/FormaPagamento.php");

class ModelFormaPagamento {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(FormaPagamento $formapagamento){
        $this->conectar();
        $query = "insert into formapagamento (nome, logo, status)"
                . " values('".$formapagamento->getNome()."', '".$formapagamento->getLogo()."',"
                . " '".$formapagamento->getStatus()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(FormaPagamento $formapagamento){
        $this->conectar();
        $query = "update formapagamento set nome = '".$formapagamento->getNome()."',"
                . " logo = '".$formapagamento->getLogo()."', status = '".$formapagamento->getStatus()."' "
               . " where codforma = '".$formapagamento->getCodforma()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codforma){
        $this->conectar();
        $query = "delete from formapagamento where codforma = '$codforma'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codforma){
        $this->conectar();
        $query = "select * from formapagamento where codforma = '$codforma'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select b.* from formapagamento b where nome like '%$nome%' order by nome";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from formapagamento order by nome";
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
