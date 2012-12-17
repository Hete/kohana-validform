<div class="alert alert-<?php echo $error->type ?>"><?php echo __("Erreur pour le champ " . $error->field . $error->message, $error->variables) ?> 
    <button type="button" class="close" data-dismiss="alert">×</button>
</div>