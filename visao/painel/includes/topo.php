<div id="topo">
    <div id="conexaosegura">
        <div align="center">
            <span>Conexão Segura</span><img src="../recursos/imagens/ConexaoSegura.png" alt="Conexão Segura"/>
        </div>
    </div>
    <?php if(isset($empresa["logo"])){?>
    <a href="http://<?=$_SERVER['SERVER_NAME'];?>/venda/admin">
        <img src="../recursos/imagens/logo_ebiro.png" alt="Imagem topo"/>
    </a>
    <?php 
    }else{
        echo("Ainda não cadastrou logo");
    }
    ?>
     <?php 
     if(isset($_SESSION["codpessoa"])){
        include("menuHorizontal.php");
     }else{
         echo("Por favor realize seu login abaixo para administrar seu site!");
     }
     ?>
</div>