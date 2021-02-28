<div id="rodape">
<div id="separar_rodape">
    <div id="menus">
        <?php
            include($antes."controlador/ProcurarCatMestre.php");
            if(isset($retornocategoria) && mysql_num_rows($retornocategoria) > 0){
                while($categoria = mysql_fetch_array($retornocategoria)){
                   echo("<a href='".$caminho."Categoria.php?codcategoria=$categoria[codcategoria]'>".$categoria["nome"]."</a><br>"); 
                }
             }else{
                 echo("Nenhuma categoria cadastrada");
             }
         ?>
    </div>
    <div id="rodape_central">
    		<div id="novadiv">
                    <form action="<?=$antes?>visao/Categoria.php" method="post">
                        <p>
                            <input type="search" size="25" maxlength="50" name="procurar" placeholder="Digite aqui a pesquisa"/>
                            <input type="submit" name="submit" value="Procurar"/>
                        </p>
                    </form>
        	</div>
        	<div id="novadiv">
                    <a href="<?=$caminho?>Conteudo.php?page=Como comprar" title="Manual de como realizar suas compras">
                        Como Comprar
                    </a>
        	</div>
        	<div id="novadiv">
                    <a href="<?=$caminho?>Conteudo.php?page=QuemSomos">Empresa</a>
        	</div>  
        	<div id="novadiv">
                    <a href="<?=$caminho?>TrabalheConosco.php">Trabalhe Conosco</a>
        	</div>         
    </div>
    <div id="infEmpresa">
        <?php if(isset($empresa["fantasia"])){echo($empresa["fantasia"]);}?><br>
        <?php if(isset($empresa["telefone"])){echo($empresa["telefone"]);}?><br>
        <?php if(isset($empresa["email"])){echo($empresa["email"]);}?><br>
        <!-- BEGIN PHP Live! code, (c) OSI Codes Inc. -->
        <script language="JavaScript" src="http://www.ebiro.com.br/venda/Chat/js/status_image.php?base_url=http://www.ebiro.com.br/venda/Chat&l=admin&x=1&deptid=0&"></script>
        <!-- END PHP Live! code : (c) OSI Codes Inc. -->              
    </div>    
</div>
    <div id="desenvolvedor" align="center">
        Copyright &copy; 2013 <?php if(date('Y') > 2013){echo("-". date('Y'));}?> - <a href="http://www.ebiro.com.br">Ebirô - Internet Solutions</a> - Todos os direitos reservados 
    </div>
</div>