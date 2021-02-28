<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissaoCargo
 *
 * @author ebiro_2
 */
class PermissaoCargo {
    
    private $codcargo;
    private $codmenu;
    private $codpermissao;
    private $status;
    
    public function getCodpermissao(){return $this->codpermissao;}
    public function setCodpermissao($codpermissao){$this->codpermissao = $codpermissao;}          
    public function getCodcargo(){return $this->codcargo;}
    public function setCodcargo($codcargo){$this->codcargo = $codcargo;}       
    public function getCodmenu(){return $this->codmenu;}
    public function setCodmenu($codmenu){$this->codmenu = $codmenu;}     
    public function getStatus(){return $this->status;}
    public function setStatus($status){$this->status = $status;}   
}

?>
