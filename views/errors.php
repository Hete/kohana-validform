<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script type="text/javascript">

    var Errors = {
        errors: <?php echo json_encode(Notification::instance()->errors()) ?>,
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

                var keyWithoutSubfield = key.replace(/\[\w+\]/, ""); // Any [] containing words and their content

                var field = jQuery("[name='" + key + "'], [name='" + keyWithoutSubfield + "']").first();
                var message = "";

                for (errorKey in errorsForField) {
                    message += errorsForField[errorKey] + " ";
                }

                // Red stuff
                field.parents(".control-group")
                        .first()
                        .addClass("error")
                        .append('<span class="help-inline">' + message + '</span>');

                // Remove the red when the field is blured
                field.blur(function() {
                    jQuery(this).parents(".control-group").first().removeClass("error");
                });
            }
        }
    };

    Errors.init();

</script>