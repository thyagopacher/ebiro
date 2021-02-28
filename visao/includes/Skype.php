<?php
if(isset($empresa["skype"]) && $empresa["skype"] !== NULL && $empresa["skype"] !== ""){
    ?>
        <script type="text/javascript" src="http://cdn.dev.skype.com/uri/skype-uri.js"></script>
        <div id="SkypeButton_Call_ebiroweb_1" title="Suporte aqui">
          <script type="text/javascript">
            Skype.ui({
              "name": "call",
              "element": "SkypeButton_Call_ebiroweb_1",
              "participants": ["<?=$empresa["skype"]?>"],
              "imageSize": 32
            });
          </script>
        </div>                                
<?php
}
?> 