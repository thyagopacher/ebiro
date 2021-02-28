<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelPlano
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Plano.php");

class ModelPlano {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Plano $plano){
        $this->conectar();
        $query = "insert into plano (descricao, valor_mensal, valor_trimenstral, valor_semestral, valor_anual, codcategoria)"
                . " values('".$plano->getDescricao()."', '".$plano->getValorMensal()."',"
                . " '".$plano->getValorTrimenstral()."', '".$plano->getValorSemestral()."',"
                . " '".$plano->getValorAnual()."', '".$plano->getCodcategoria()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Plano $plano){
        $this->conectar();
        $query = "update plano set descricao = '".$plano->getDescricao()."', "
                . " valor_mensal = '".$plano->getValorMensal()."', valor_trimenstral = '".$plano->getValorTrimenstral()."',"
                . " valor_semestral = '".$plano->getValorSemestral()."', valor_anual = '".$plano->getValorAnual()."',"
                . " codcategoria = '".$plano->getCodcategoria()."'  where codplano = '".$plano->getCodplano()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codplano){
        $this->conectar();
        $query = "delete from plano where codplano = '$codplano'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codplano){
        $this->conectar();
        $query = "select * from plano where codplano = '$codplano'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarDescricao($descricao){
        $this->conectar();
        $query = "select * from plano where descricao like '%$descricao%' order by valor_mensal asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from plano";
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
