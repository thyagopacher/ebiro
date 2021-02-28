<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelFabricante
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Fabricante.php");

class ModelFabricante {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Fabricante $fabricante){
        $this->conectar();
        $query = "insert into fabricante (nome, logo)"
                . " values('".$fabricante->getNome()."', '".$fabricante->getLogo()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Fabricante $fabricante){
        $this->conectar();
        $query = "update fabricante set nome = '".$fabricante->getNome()."', logo = '".$fabricante->getLogo()."',"
               . " where codfabricante = '".$fabricante->getCodfabricante()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codfabricante){
        $this->conectar();
        $query = "delete from fabricante where codfabricante = '$codfabricante'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codfabricante){
        $this->conectar();
        $query = "select * from fabricante where codfabricante = '$codfabricante'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select f.*,"
                . "(select count(*) from produto where codfabricante = f.codfabricante) as qtd"
                . " from fabricante f where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarCategoria($codcategoria){
        $this->conectar();
        $query = "select distinct f.* from fabricante f,"
                . " produto p"
                . " where p.codfabricante = f.codfabricante and"
                . " p.codcategoria = '$codcategoria'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from fabricante";
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
