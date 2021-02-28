<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCategoriaProduto
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/CategoriaProduto.php");

class ModelCategoriaProduto {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(CategoriaProduto $categoria){
        $this->conectar();
        $query = "insert into categoriaproduto (nome, codmestre)"
                . " values('".$categoria->getNome()."', '".$categoria->getCodmestre()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(CategoriaProduto $categoria){
        $this->conectar();
        $query = "update categoriaproduto set nome = '".$categoria->getNome()."', "
                . " codmestre = '".$categoria->getCodmestre()."'"
                . " where codcategoria = '".$categoria->getCodcategoria()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcategoria){
        $this->conectar();
        $query = "delete from categoriaproduto where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcategoria){
        $this->conectar();
        $query = "select cp.*, (select count(*) from produto where codcategoria = cp.codcategoria) as qtd from categoriaproduto cp where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);   
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select cp.*,"
                . "(select nome from categoriaproduto where codcategoria = cp.codmestre) as mestre,"
                . "(select count(*) from produto where codcategoria = cp.codcategoria) as qtd"
                . " from categoriaproduto cp where nome like '%$nome%' order by nome";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query = "select cp.* from categoriaproduto cp order by nome";
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
