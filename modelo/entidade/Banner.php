<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banner
 *
 * @author ebiro_2
 */
class Banner {
    
    private $codbanner;
    private $link;
    private $imagem;
    private $posicao;
    public function getCodbanner(){return $this->codbanner;}
    public function setCodbanner($codbanner){$this->codbanner = $codbanner;}       
    public function getImagem(){return $this->imagem;}
    public function setImagem($imagem){$this->imagem = $imagem;}      
    public function getLink(){return $this->link;}
    public function setLink($link){$this->link = $link;}     
    public function getPosicao(){return $this->posicao;}
    public function setPosicao($posicao){$this->posicao = $posicao;}   
}

?>
