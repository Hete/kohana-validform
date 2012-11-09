<?php

class ValidForm_Notification {

    public $type, $message;

    /**
     * 
     * @param type $message
     * @param array $variables
     * @param type $type Par défaut, les notifications sont de type 
     */
    public function __construct($message, array $variables = NULL, $type = "") {
        $this->type = $type;
        $this->message = __($message, $variables);
    }

}

?>
