<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelPagina
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Pagina.php");

class ModelPagina {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Pagina $pagina){
        $this->conectar();
        $query = "insert into pagina (titulo, texto)"
                . " values('".$pagina->getTitulo()."', '".$pagina->getTexto()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Pagina $pagina){
        $this->conectar();
        $query = "update pagina set texto = '".$pagina->getTexto()."', "
                . " titulo = '".$pagina->getTitulo()."'"
                . " where codpagina = '".$pagina->getCodpagina()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codpagina){
        $this->conectar();
        $query = "delete from pagina where codpagina = '$codpagina'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codpagina){
        $this->conectar();
        $query = "select * from pagina where codpagina = '$codpagina'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTitulo($titulo){
        $this->conectar();
        $query = "select b.* from pagina b where titulo like '%$titulo%' order by titulo";
        echo($query);
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from pagina order by titulo";
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
