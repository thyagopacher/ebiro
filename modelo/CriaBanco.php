<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("Conexao.php");
    
class CriaBanco {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    } 
    
    public function criaTabela($tabela){
        $this->conectar();
        $query = "CREATE TABLE $tabela ("
            . "cod$tabela Integer PRIMARY KEY auto_increment)";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }    
    
    public function adicionarTabela($tabela, $atributo, $tipo){
        $this->conectar();
        $query = "alter table $tabela add $atributo $tipo";
        $this->conexao->converteUTF8();
        return mysql_query($query);
    }
}
?>
