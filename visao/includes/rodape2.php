            <div id="rodape2">
                <div id="grupos2">
                    <div>
                        <h4>Formas de pagamento</h4>
                        <?php include("formaPagamento.php");?>
                    </div>
                    <div class="texto2">
                        A melhor plataforma de e-commerce<br>
                        para sua loja virtual.<br>
                        Confira os planos clicando aqui!<br>
                    </div>
                    <div id="redesocial">
                        <div id="twitter">
                            <a style="margin-right: 5px;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?=$caminho2?>" data-lang="pt" data-dnt="true">
                                Tweetar
                            </a>
                            <script src="<?=$caminho?>/recursos/javascript/Twitter.js"></script>             
                        </div>
                        <?php include("visao/includes/google+.php");?>   
                        <div class="fb-like" data-href="<?=$caminho2?>" data-width="30" data-height="30" data-colorscheme="light" data-layout="standard" data-action="like" data-show-faces="true" data-send="false"></div>   
                    </div>
                </div>
            </div> 

        <!-- The JavaScript para o menu departamentos-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
				var $oe_menu		= $('#oe_menu');
				var $oe_menu_items	= $oe_menu.children('li');
				var $oe_overlay		= $('#oe_overlay');

                $oe_menu_items.bind('mouseenter',function(){
					var $this = $(this);
					$this.addClass('slided selected');
					$this.children('div').css('z-index','9999').stop(true,true).slideDown(200,function(){
						$oe_menu_items.not('.slided').children('div').hide();
						$this.removeClass('slided');
					});
				}).bind('mouseleave',function(){
					var $this = $(this);
					$this.removeClass('selected').children('div').css('z-index','1');
				});

				$oe_menu.bind('mouseenter',function(){
					var $this = $(this);
					$oe_overlay.stop(true,true).fadeTo(200, 0.6);
					$this.addClass('hovered');
				}).bind('mouseleave',function(){
					var $this = $(this);
					$this.removeClass('hovered');
					$oe_overlay.stop(true,true).fadeTo(200, 0);
					$oe_menu_items.children('div').hide();
				})
            });
        </script>