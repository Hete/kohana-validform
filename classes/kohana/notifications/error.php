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
        $this->message = $message;
        $this->variables = $variables;
        $this->type = $type;
    }

    /**
     * 
     * @return string
     */
    public function __toString() {
        return __("notifications.error", array(":field" => $this->field, ":message" => parent::__toString()));
    }

}

?>
