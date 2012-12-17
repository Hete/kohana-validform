<?php

/**
 * Notification.
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @copyright (c) 2012, Hète.ca Inc.
 */
class Kohana_Notification implements Consumeable {

    public static function factory($message, array $variables = NULL, $type = NULL) {
        return new Notification($message, $variables, $type);
    }

    private $_consumed = FALSE;

    public function __construct($message, array $variables = NULL, $type = NULL) {
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
