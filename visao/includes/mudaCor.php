<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        <style>
<?php
    if(isset($configuracao["cortopo"]) && $configuracao["cortopo"] !== NULL && $configuracao["cortopo"] !== ""){
?>
            #topo{
                background: <?=$configuracao["cortopo"]?>;
            }
<?php
    }
    if(isset($configuracao["corbody"]) && $configuracao["corbody"] !== NULL && $configuracao["corbody"] !== ""){
?>
            body{
                background: <?=$configuracao["corbody"]?>;
            }            
<?php
    }
    if(isset($configuracao["corrodape"]) && $configuracao["corrodape"] !== NULL && $configuracao["corrodape"] !== ""){
?>
            #rodape{
                background: <?=$configuracao["corrodape"]?>;
            }               
<?php
    }
?>
        </style>