<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelMenu
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Menu.php");

class ModelMenu {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Menu $menu){
        $this->conectar();
        $query = "insert into menu (nome, arquivo, codcategoria, icone, quadro)"
                . " values('".$menu->getNome()."', '".$menu->getArquivo()."', '".$menu->getCodcategoria()."', '".$menu->getIcone()."', '".$menu->getQuadro()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Menu $menu){
        $this->conectar();
        $query = "update menu set nome = '".$menu->getNome()."', arquivo = '".$menu->getArquivo()."', codcategoria = '".$menu->getCodcategoria()."',"
                . " icone = '".$menu->getIcone()."', quadro = '".$menu->getQuadro()."' "
               . " where codmenu = '".$menu->getCodmenu()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codmenu){
        $this->conectar();
        $query = "delete from menu where codmenu = '$codmenu'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codmenu){
        $this->conectar();
        $query = "select * from menu where codmenu = '$codmenu'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select m.*,"
                . "(select nome from categoriamenu where codcategoria = m.codcategoria) as categoria,"
                . "m.nome as menu"
                . " from menu m where m.nome like '%$nome%' order by m.nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from menu";
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
