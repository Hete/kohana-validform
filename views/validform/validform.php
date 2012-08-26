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
