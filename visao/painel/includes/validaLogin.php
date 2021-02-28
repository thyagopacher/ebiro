<?php
    session_start();
    if(!isset($_SESSION["codpessoa"])){
        echo("<script>alert('Somente podera acessar apos se logar!');</script>");
        echo("<script>location.href='index.php';</script>");
    }
?>