<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript">

    var Errors = {
        errors: <?php echo Notifications::instance()->errors()->consume_all()->to_json() ?>,
        init: function() {
            
            // Build a field => error array
            
            var fields = {};
            
            for(key in Errors.errors) {
                var error = Errors.errors[key];  

                if(fields[error.field] === undefined) {
                    fields[error.field] = [];
                }

                fields[error.field].push(error.message);
                
            }
            
            for(key in fields) {
                
                var errorsForField = fields[key];                
                var field =  $("#" + key);                
                var message = "";
                
                for(errorKey in errorsForField) {
                    message += errorsForField[errorKey];
                }        
                
                
                // Red stuff
                field.parents(".control-group")
                .first()
                .addClass("error")
                .append('<span class="help-inline">' + message + '</span>');               
                
                
                
            }            
        }
            
          

    };

    $(document).ready(Errors.init);


</script>