<script type="text/javascript">
    
    var ValidForm = {
        errors : <?php echo ValidForm::instance()->to_json() ?>,
        init: function() {
            for(key in this.errors) {
                var field =  $("#" + key);
                
                field.parents(".control-group").addClass("error");
                
                var message = "<ul class='unstyled'>";
                
                for(field_error in this.errors[key]) {
                    
                    message += "<li>" + this.errors[key][field_error] + "</li>";
                    
                }
                
                message += "</ul>";
                
                field.popover({     
                    html: true,
                    trigger:'hover',
                    content:message
                }).popover('show');
                
                
              
            }
          
          
        }  
        
    };
    
    ValidForm.init(); 
                            
                    
                
</script>
