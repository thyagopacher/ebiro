<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelPergunta
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Pergunta.php");

class ModelPergunta {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Pergunta $pergunta){
        $this->conectar();
        $query = "insert into pergunta (pergunta, resposta, codcategoria)"
                . " values('".$pergunta->getPergunta()."', '".$pergunta->getResposta()."', '".$pergunta->getCodcategoria()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Pergunta $pergunta){
        $this->conectar();
        $query = "update pergunta set pergunta = '".$pergunta->getPergunta()."', "
                . " resposta = '".$pergunta->getResposta()."', codcategoria = '".$pergunta->getCodcategoria()."' where codpergunta = '".$pergunta->getCodpergunta()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codpergunta){
        $this->conectar();
        $query = "delete from pergunta where codpergunta = '$codpergunta'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codpergunta){
        $this->conectar();
        $query = "select p.*,"
                . "(select nome from categoriapergunta where codcategoria = p.codcategoria) as categoria"
                . " from pergunta p where p.codpergunta = '$codpergunta'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarPergunta($pergunta){
        $this->conectar();
        $query = "select p.*,"
                . "(select nome from categoriapergunta where codcategoria = p.codcategoria) as categoria"
                . " from pergunta p where pergunta like '%$pergunta%' order by p.pergunta asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from pergunta";
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
