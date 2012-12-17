<?php

/**
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Kohana_Error implements Consumeable {

    public static function factory($field, $message, $variables = NULL, $type = "error") {
        return new Error($field, $message, $variables, $type);
    }
    
    private $_consumed = FALSE;

    public function __construct($field, $message, $variables = NULL, $type = "error") {
        $this->field = $field;
        $this->message = $message;
        $this->variables = $variables;
        $this->type = $type;
    }

    public function consume() {
        $this->_consumed = TRUE;
    }

    public function consumed() {
        return $this->_consumed;
    }

    

    

}

?>
