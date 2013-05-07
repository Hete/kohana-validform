<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Notification manager.
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @copyright (c) 2012, Hète.ca Inc.
 */
class Kohana_Notification {

    const INFO = "info", WARNING = "warning", ERROR = "error", SUCCESS = "success";

    /**
     * Default writer.
     * 
     * @var string 
     */
    public static $default_writer = "Session";

    /**
     * Singleton.
     * 
     * @var Notification
     */
    protected static $_instance;

    /**
     *
     * @return Notification
     */
    public static function instance() {

        if (static::$_instance === NULL) {

            static::$_instance = new Notification();

            // Write on shutdown
            register_shutdown_function(array(static::$_instance, "write"));
        }

        return static::$_instance;
    }

    /**
     * Array of Errors objects.
     * @var array
     */
    private $_errors = array();

    /**
     * Array of Notification objects.
     * @var array 
     */
    private $_notifications = array();

    /**
     *
     * @var \Notification_Writer 
     */
    private $writer;

    /**
     * 
     */
    private function __construct() {

        $writer = "Notification_" . static::$default_writer;

        $this->writer = new $writer();

        $this->read();
    }

    /**
     * Add a notification.
     * 
     * @param type $message
     * @param type $values
     * @param type $level
     */
    public function add($message = NULL, $values = NULL, $level = Notifications::INFO) {
        $this->_notifications[] = array(
            "message" => $message,
            "values" => $values,
            "level" => $level,
        );
    }

    /**
     * Getter for notifications.
     * 
     * @return array
     */
    public function notifications() {
        $_notifications = $this->_notifications;
        $this->_notifications = array();
        return $_notifications;
    }

    /**
     * Add errors.
     * 
     * @param Error $errors can be an Error object, a ORM_Validation_Exception, 
     * a Validation_Exception or a field. If a field is specified, a message must
     * be providen. Otherwise a Kohana_Exception will be thrown.
     */
    public function errors($errors = NULL) {

        if ($errors === NULL) {
            $_errors = $this->_errors;
            $this->_errors = array();
            return $_errors;
        }

        if ($errors instanceof ORM_Validation_Exception) {
            $errors = Arr::flatten($errors->errors(Kohana::$config->load("notifications.orm_directory")));
        }

        if ($errors instanceof Validation) {
            $errors = Arr::flatten($errors->errors(Kohana::$config->load("notifications.validation_file")));
        }

        if ($errors instanceof Validation_Exception) {
            $errors = Arr::flatten($errors->array->errors(Kohana::$config->load("notifications.validation_file")));
        }

        // At this point, we assume $errors is an array

        $this->_errors = Arr::merge($this->_errors, $errors);
    }

    /**
     * Read data from session.
     * 
     * @return type
     */
    public function read() {
        list($this->_notifications, $this->_errors) = $this->writer->read();
    }

    /**
     * Write data to session.
     */
    public function write() {
        $this->writer->write($this->_notifications, $this->_errors);
    }

}

?>
