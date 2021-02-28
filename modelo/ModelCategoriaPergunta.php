<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCategoriaPergunta
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/CategoriaPergunta.php");

class ModelCategoriaPergunta {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(CategoriaPergunta $categoria){
        $this->conectar();
        $query = "insert into categoriapergunta (nome)"
                . " values('".$categoria->getNome()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(CategoriaPergunta $categoria){
        $this->conectar();
        $query = "update categoriapergunta set nome = '".$categoria->getNome()."'"
                . " where codcategoria = '".$categoria->getCodcategoria()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcategoria){
        $this->conectar();
        $query = "delete from categoriapergunta where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcategoria){
        $this->conectar();
        $query = "select cp.*, (select count(*) from pergunta where codcategoria = cp.codcategoria) as qtd from categoriapergunta cp where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);   
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select cp.*,"
                . "(select count(*) from pergunta where codcategoria = cp.codcategoria) as qtd"
                . " from categoriapergunta cp where nome like '%$nome%' order by nome";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query = "select cp.* from categoriapergunta cp order by nome";
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
