

<script type="text/javascript">
    
    var Errors = {
        errors : <?php echo Notifications::instance()->errors_to_json() ?>,
        init: function() {
            for(key in this.errors) {             
                
                var error = this.errors[key];                
                
                var field =  $("#" + error.field);
                
                field.parents(".control-group").addClass("error");               
                
                
                field.popover({     
                    html: true,
                    trigger:'hover',
                    content: error.message
                }).popover('show');
                
                
              
            }
          
          
        }  
        
    };
    
    Errors.init();                            
                    
                
</script>