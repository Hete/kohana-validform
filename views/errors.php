<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php echo HTML::script("http://code.jquery.com/jquery.min.js") ?>

<script type="text/javascript">

    jQuery.noConflict();

    var Errors = {
        errors: <?php echo json_encode(Notification::instance()->errors()) ?>,
        init: function() {
            for (key in Errors.errors) {

                var errors = Errors.errors[key];

                if (!jQuery.isArray(errors)) {
                    errors = [errors];
                }

                // Any [] containing words and their content
                jQuery("[name$='[" + key + "]']")
                        .add("[name$='[" + key.replace(/\[\w+\]/, "") + "]']")
                        .add("[name='" + key + "']")
                        .each(function() {
                    var controlGroup = jQuery(this).blur(Errors.removeError) // Remove error on blur
                            .parents(".control-group")
                            .first()
                            .addClass("error");
                    jQuery.each(errors, function(key, value) {
                        // value is a message, key is an index it must be capitalized          
                        controlGroup.append('<span class="help-inline">' + value.charAt(0).toUpperCase() + value.slice(1) + '.</span>');
                    });
                });



            }
        },
        removeError: function() {
            jQuery(this).parents(".control-group").first().removeClass("error");
        }

    };

    jQuery(document).ready(Errors.init);

</script>