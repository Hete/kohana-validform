<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Kohana_Notifications_Error extends Notifications_Message {

    public $field;

    public static function factory($field, $message, array $variables = NULL, $type = "error") {
        return new Notifications_Error($field, $message, $variables, $type);
    }

    /**
     * 
     * @param string $field
     * @param string $message
     * @param array $variables
     * @param string $type
     */
    public function __construct($field, $message, array $variables = NULL, $type = "error") {
        $this->field = $field;
        $this->message = UTF8::ucfirst(__($message, $variables)) . ".";
        $this->type = $type;
    }

    public function __toString() {
        return ucfirst(parent::__toString()) . ".";
    }

}

?>
