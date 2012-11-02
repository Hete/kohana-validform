<?php

class ValidForm_Notification {

    public $type, $message;

    public function __construct($message, $type ) {
        $this->type = $type;
        $this->message = $message;
    }

}

?>
