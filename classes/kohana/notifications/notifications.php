<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Notification manager.
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <john.doe@example.com>
 */
class Kohana_Notifications_Notifications {

    /**
     *
     * @var Notifications 
     */
    protected static $_instance;

    /**
     *
     * @return Notifications 
     */
    public static function instance() {

        if (Notifications::$_instance !== NULL) {
            return Notifications::$_instance;
        }

        Notifications::$_instance = new Notifications();

        register_shutdown_function(array(Notifications::$_instance, 'write'));

        return Notifications::$_instance;
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
     */
    private function __construct() {

        // Reload errors and notifications from session
        $this->read();
    }

    /**
     * Add notification.
     * @param Notifications_Notification $message
     * @param array $variables
     * @param type $type
     * @return \Kohana_Message_Iterator|\Kohana_Notifications_Notifications
     * @throws Kohana_Exception
     */
    public function notifications($message = NULL, array $variables = NULL, $type = NULL) {

        $this->update_data();

        if ($message === NULL) {

            // ACT AS A GETTER
            return new Notifications_Message_Iterator($this->_notifications);
        }

        if ($message instanceof Notifications_Notification) {
            $this->_notifications[] = $message;
        } elseif (is_string($message)) {
            $this->_notifications[] = Notifications_Notification::factory($message, $variables, $type);
        } else {
            throw new Kohana_Exception("Notification supplied must be instance of Notification or be a string.");
        }

        $this->write();

        return $this;
    }

    /**
     * Add an error on a field.
     * @param Error $error can be an Error object, a ORM_Validation_Exception, 
     * a Validation_Exception or a field. If a field is specified, a message must
     * be providen. Otherwise a Kohana_Exception will be thrown.
     * @param type $message is the error message if $error is a field.
     * @param array $variables is the variables related to the message.
     * @param type $type is the error type.
     * @return \Kohana_Message_Iterator|\Kohana_Notifications_Notifications
     * @throws Kohana_Exception if a field is supplied but no message is related
     * to it.
     */
    public function errors($error = NULL, $alias = NULL) {

        $this->update_data();

        if ($error === NULL) {
            // ACT AS A GETTER
            return new Notifications_Message_Iterator($this->_errors);
        }

        if ($error instanceof Notifications_Error) {
            $this->_errors[] = $error;
        } elseif ($error instanceof ORM_Validation_Exception) {
            $this->add_orm_validation_exception_errors($error, $alias);
        } elseif ($error instanceof Validation_Exception) {
            $this->add_validation_exception_errors($error, $alias);
        } elseif ($error instanceof Validation) {
            $this->add_validation_errors($error, $alias);
        } elseif (Arr::is_array($error)) {
            $this->add_array_errors($error, $alias);
        } else {
            throw new Kohana_Exception("Errors supplied must be instance of ORM_Validation_Exception or Validation.");
        }

        $this->write();

        return $this;
    }

    /**
     * Remove consumed items.
     * @return \Kohana_Notifications_Notifications
     */
    public function update_data() {
        foreach ($this->_errors as $key => $error) {
            if ($error->consumed()) {
                unset($this->_errors[$key]);
            }
        }
        foreach ($this->_notifications as $key => $notification) {
            if ($notification->consumed()) {
                unset($this->_notifications[$key]);
            }
        }
        return $this;
    }

    /**
     * Reload data from cache.
     * @return \Kohana_Notifications
     */
    public function read() {
        $this->update_data();
        $this->_errors = Session::instance()->get("errors", array());
        $this->_notifications = Session::instance()->get("notifications", array());
        return $this;
    }

    /**
     * Update the session data with current notifications.
     */
    public function write() {
        // First remove consumed items
        $this->update_data();
        // Then update the cache
        Session::instance()->set("errors", $this->_errors);
        Session::instance()->set("notifications", $this->_notifications);
        return $this;
    }

    /**
     * 
     * @param ORM_Validation_Exception $ove
     */
    private function add_orm_validation_exception_errors(ORM_Validation_Exception $ove, $alias = NULL) {

        if ($alias === NULL) {
            $alias = $ove->alias();
        }

        foreach ($ove->errors("model") as $field => $errors) {
            if (Arr::is_array($errors)) {
                foreach ($errors as $sub_field => $error) {
                    $this->_errors[] = Notifications_Error::factory($alias . "[$sub_field]", $error);
                }
            } else {
                $this->_errors[] = Notifications_Error::factory($alias . "[$field]", $errors);
            }
        }
        return $this;
    }

    /**
     * 
     * @param Validation $validation
     */
    private function add_validation_exception_errors(Validation_Exception $validation, $alias = NULL) {
        return $this->add_validation_errors($validation->array);
    }

    /**
     * 
     * @param Validation $validation
     * @param type $alias
     * @return \Kohana_Notifications_Notifications
     */
    private function add_validation_errors(Validation $validation, $alias = NULL) {
        foreach ($validation->errors("valid") as $field => $errors) {
            if (Arr::is_array($errors)) {
                foreach ($errors as $sub_field => $error) {
                    if (is_string($error)) {
                        $this->_errors[] = Notifications_Error::factory($alias . "[$sub_field]", $error);
                    }
                }
            } elseif (is_string($errors)) {
                $this->_errors[] = Notifications_Error::factory($alias . "[$field]", $errors);
            }
        }
        return $this;
    }

    private function add_array_errors(array $validation, $alias = NULL) {
        foreach ($validation as $field => $errors) {
            if (Arr::is_array($errors)) {
                foreach ($errors as $sub_field => $error) {
                    if (is_string($error)) {
                        $this->_errors[] = Notifications_Error::factory($alias . "[$sub_field]", $error);
                    }
                }
            } elseif (is_string($errors)) {
                $this->_errors[] = Notifications_Error::factory($alias . "[$field]", $errors);
            }
        }
    }

    /**
     * 
     * @return boolean
     */
    public function has_notifications() {
        return (bool) count($this->notifications());
    }

    /**
     * 
     * @return boolean
     */
    public function has_errors() {
        return (bool) count($this->errors());
    }

    /**
     * @todo Description
     * @return sting
     */
    public function notifications_to_json() {
        return json_encode($this->notifications());
    }

    /**
     * 
     * @return sting
     */
    public function errors_to_json() {
        return json_encode($this->errors());
    }

}

?>
