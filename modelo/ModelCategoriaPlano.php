<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCategoriaPlano
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/CategoriaPlano.php");

class ModelCategoriaPlano {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(CategoriaPlano $categoria){
        $this->conectar();
        $query = "insert into categoriaplano (nome)"
                . " values('".$categoria->getNome()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(CategoriaPlano $categoria){
        $this->conectar();
        $query = "update categoriaplano set nome = '".$categoria->getNome()."'"
                . " where codcategoria = '".$categoria->getCodcategoria()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcategoria){
        $this->conectar();
        $query = "delete from categoriaplano where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcategoria){
        $this->conectar();
        $query = "select cp.*, (select count(*) from plano where codcategoria = cp.codcategoria) as qtd from categoriaplano cp where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);   
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select cp.*,"
                . "(select count(*) from plano where codcategoria = cp.codcategoria) as qtd"
                . " from categoriaplano cp where nome like '%$nome%' order by nome";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query = "select cp.* from categoriaplano cp order by nome";
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
