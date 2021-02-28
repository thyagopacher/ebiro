<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelComentario
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Comentario.php");

class ModelComentario {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Comentario $comentario){
        $this->conectar();
        $query = "insert into comentario (nome, email, status, texto, codproduto)"
                . " values('".$comentario->getNome()."', '".$comentario->getEmail()."', '1', '".$comentario->getTexto()."',"
                . " '".$comentario->getCodproduto()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Comentario $comentario){
        $this->conectar();
        $query = "update comentario set nome = '".$comentario->getNome()."', "
                . " email = '".$comentario->getEmail()."', status = '".$comentario->getStatus()."'"
                . " texto = '".$comentario->getTexto()."', codproduto = '".$comentario->getCodproduto()."'"
                . " where codcomentario = '".$comentario->getCodcomentario()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcomentario){
        $this->conectar();
        $query = "delete from comentario where codcomentario = '$codcomentario'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcomentario){
        $this->conectar();
        $query = "select v.* from comentario v where codcomentario = '$codcomentario'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select v.* from comentario v from comentario v where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select v.* from comentario v";
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
