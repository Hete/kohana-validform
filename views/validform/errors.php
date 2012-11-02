<style>
    .erreurtest {
        background: -webkit-linear-gradient(top, #d94a61, #c62a43);
        background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#d94a61), to(#c62a43));
        background: -moz-linear-gradient(top, #d94a61, #c62a43);
        background: -ms-linear-gradient(top, #d94a61, #c62a43);
        background: -o-linear-gradient(top, #d94a61, #c62a43);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled='true',
            startColorstr=#d94a61, endColorstr=#c62a43);
        background-color: #c62a43;
        width:200px;
        border-radius: 5px;
        padding: 10px;
        font-style: normal;
        font-size: 12px;
        color: #fff;
        position:relative;
        left: 100px;
        top: 5px;
    }



    .erreurtest img {
        position:absolute;
        top: -10px;
    }




</style>


<div id="orphan-errors"></div>

<div style="display: none">
    <div id="erreurtest-template" style="display: none;">
        <div class='erreurtest' style="position: relative">
            <?php echo HTML::image("asset/image/pointeur-info-bulle.png") ?>

            <div class='icone_infobulle'></div><span class="erreur_text">Ceci est un test d'info-bulle.</span>
        </div>
    </div>
</div>

<script type="text/javascript">
                            
    var validationErrors = <?php echo ValidForm::instance()->retreive_errors() ?>;
                            
    for(key in validationErrors) {
        
        
        
        var input = $("input[name='" + key + "']");
        
        if(!input.length) {
            // ON append l'erreur dans le code de ValidForm.
            input = $("#orphan-errors");
        }
        
        
        
        var offsets = input.offset();
        offsets.top  += input.height() + 40;             

                                
        var clone = $("#erreurtest-template").clone();
                               
        clone.find('.erreur_text').html(validationErrors[key]); 
        
        
        input.after(clone.html());

                                
                             
        clone.css({'left': 100});                        
                                
                                
                                
    }
                            
                            
                    
                
</script>
