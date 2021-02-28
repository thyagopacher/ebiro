<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author ebiro_2
 */
class Menu {
    
    private $codmenu;
    private $arquivo;
    private $nome;
    private $codcategoria;
    private $icone;
    private $quadro;
    public function getCodmenu(){return $this->codmenu;}
    public function setCodmenu($codmenu){$this->codmenu = $codmenu;}        
    public function getArquivo(){return $this->arquivo;}
    public function setArquivo($arquivo){$this->arquivo = $arquivo;}     
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}
    public function getCodcategoria(){return $this->codcategoria;}
    public function setCodcategoria($codcategoria){$this->codcategoria = $codcategoria;}
    public function getIcone(){return $this->icone;}
    public function setIcone($icone){$this->icone = $icone;}    
    public function getQuadro(){return $this->quadro;}
    public function setQuadro($quadro){$this->quadro = $quadro;}     
}

?>
