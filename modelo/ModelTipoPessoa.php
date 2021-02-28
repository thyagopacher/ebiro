<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelTipoPessoa
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/TipoPessoa.php");

class ModelTipoPessoa {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(TipoPessoa $tipopessoa){
        $this->conectar();
        $query = "insert into tipopessoa (nome)"
                . " values('".$tipopessoa->getNome()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(TipoPessoa $tipopessoa){
        $this->conectar();
        $query = "update tipopessoa set nome = '".$tipopessoa->getNome()."' "
                . " where codtipo = '".$tipopessoa->getCodtipo()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codtipo){
        $this->conectar();
        $query = "delete from tipopessoa where codtipo = '$codtipo'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codtipo){
        $this->conectar();
        $query = "select * from tipopessoa where codtipo = '$codtipo'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select tp.* , "
                . "(select count(*) from pessoa where codtipo = tp.codtipo) as qtd"
                . " from tipopessoa tp where nome like '%$nome%' order by tp.nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select tp.* ,"
                . "(select count(*) from pessoa where codtipo = tp.codtipo) as qtd"
                . "  from tipopessoa p order by tp.nome asc";
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
