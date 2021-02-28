<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelPermissaoCargo
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/PermissaoCargo.php");

class ModelPermissaoCargo {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function comando($query){
        $this->conectar();
        $this->conexao->converteUTF8();
        return mysql_query($query);
    }
    
    public function inserirObjeto(PermissaoCargo $permissaocargo){
        $this->conectar();
        if($permissaocargo->getCodmenu() === '0'){
            $permissaocargo->setStatus("Todos");
        }
        $query = "insert into permissaocargo (codmenu, codcargo, status)"
            . " values('".$permissaocargo->getCodmenu()."', '".$permissaocargo->getCodcargo()."', '".$permissaocargo->getStatus()."');";        
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(PermissaoCargo $permissaocargo){
        $this->conectar();
        if($permissaocargo->getCodmenu() === '0'){
            $permissaocargo->setStatus("Todos");
        }
        $query = "update permissaocargo set codmenu = '".$permissaocargo->getCodmenu()."', codcargo = '".$permissaocargo->getCodcargo()."', "
                . " status = '".$permissaocargo->getStatus()."'"
                . " where codpermissao = '".$permissaocargo->getCodpermissao()."'";        
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codpermissao){
        $this->conectar();
        $query = "delete from permissaocargo where codpermissao = '$codpermissao'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codpermissao){
        $this->conectar();
        $query = "select pc.*,"
                . "(select nome from cargo where codcargo = pc.codcargo) as cargo,"
                . "(select nome from menu where codmenu = pc.codmenu) as menu,"
                . "(select arquivo from menu where codmenu = pc.codmenu) as arquivo"
                . " from permissaocargo pc where pc.codpermissao = '$codpermissao'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarCargo($codcargo){
        $this->conectar();
        $query = "select ";
        $query .= " m.*,";
        $query .=  "m.nome as menu,";
        $query .= " (select distinct 'SIM' from permissaocargo pc where pc.codcargo = '$codcargo' and pc.codmenu = m.codmenu)as status";
        $query .= " from menu m";      
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarCodmenu($codmenu){
        $this->conectar();
        $query = "select c.* "
                . " from permissaocargo c where codmenu like '%$codmenu%' order by codmenu asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select c.* "
                 . "  from permissaocargo p";
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
