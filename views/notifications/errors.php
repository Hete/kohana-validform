<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript">

    var Errors = {
        errors: <?php echo Notifications::instance()->errors()->consume_all()->to_json() ?>,
        init: function() {

            // Build a field => error array

            var fields = {};

            for (key in Errors.errors) {
                var error = Errors.errors[key];

                if (fields[error.field] === undefined) {
                    fields[error.field] = [];
                }

                fields[error.field].push(error.message);

            }

            for (key in fields) {

                var errorsForField = fields[key];
                var field = $("[name='" + key + "']");
                var message = "";

                for (errorKey in errorsForField) {
                    message += errorsForField[errorKey];
                }


                // Red stuff
                field.parents(".control-group")
                        .first()
                        .addClass("error")
                        .append('<span class="help-inline">' + message + '</span>');

                // Remove the red when the field is blured
                field.blur(function() {
                    $(this).parents(".control-group").first().removeClass("error");
                });


            }


        }



    };

    $(document).ready(Errors.init);


</script>