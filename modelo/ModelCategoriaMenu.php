<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCategoriaMenu
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/CategoriaMenu.php");

class ModelCategoriaMenu {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(CategoriaMenu $categoria){
        $this->conectar();
        $query = "insert into categoriamenu (nome)"
                . " values('".$categoria->getNome()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(CategoriaMenu $categoria){
        $this->conectar();
        $query = "update categoriamenu set nome = '".$categoria->getNome()."'"
                . " where codcategoria = '".$categoria->getCodcategoria()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcategoria){
        $this->conectar();
        $query = "delete from categoriamenu where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcategoria){
        $this->conectar();
        $query = "select cp.*, (select count(*) from menu where codcategoria = cp.codcategoria) as qtd from categoriamenu cp where codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);   
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select cp.*,"
                . "(select count(*) from menu where codcategoria = cp.codcategoria) as qtd"
                . " from categoriamenu cp where nome like '%$nome%' order by nome";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query = "select cp.* from categoriamenu cp order by nome";
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
