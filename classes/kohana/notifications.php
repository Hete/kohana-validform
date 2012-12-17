<?php

/**
 * Utility to validate forms and show notifications.
 */
class Kohana_Notifications {

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
        return Notifications::$_instance ? Notifications::$_instance : Notifications::$_instance = new Notifications();
    }

    /**
     *
     * @var array
     */
    private $_errors = array();

    /**
     *
     * @var array 
     */
    private $_notifications = array();

    /**
     * 
     */
    private function __construct() {

        // Reload errors and notifications from session
        $this->reload_cache();
    }

    /**
     * Add notification
     */
    public function notifications($notification = NULL, array $variables = NULL, $type = NULL) {

        $this->reload_data();

        if ($notification === NULL) {

            // ACT AS A GETTER
            return new ArrayIterator($this->_notifications);
        }

        if ($notification instanceof Notification) {
            $this->_notifications[] = $notification;
        } elseif (is_string($notification)) {
            $this->_notifications[] = Notification::factory($notification, $variables, $type);
        } else {
            throw new Kohana_Exception("Notification supplied must be instance of Notification or be a string.");
        }

        $this->update_cache();
    }

    /**
     * Add error
     * @param Error $error
     */
    public function errors($error = NULL) {

        $this->reload_data();

        if ($error === NULL) {
            // ACT AS A GETTER
            return new ArrayIterator($this->_errors);
        }

        if ($error instanceof Error) {
            $this->_errors[] = $error;
        } elseif ($error instanceof ORM_Validation_Exception) {
            $this->add_orm_validation_exception_errors($error);
        } elseif ($error instanceof Validation_Exception) {
            $this->add_validation_exception_errors($error->array);
        } else {
            throw new Kohana_Exception("Errors supplied must be instance of ORM_Validation_Exception or Validation.");
        }

        $this->update_cache();

        return $this;
    }

    /**
     * Remove consumed items.
     * @return \Kohana_Notifications
     */
    private function reload_data() {
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
     * Reload data from cache
     * @return \Kohana_Notifications
     */
    private function reload_cache() {
        $this->_errors = Session::instance()->get("errors", array());
        $this->_notifications = Session::instance()->get("notifications", array());
        return $this;
    }

    /**
     * 
     */
    private function update_cache() {
        Session::instance()->set("errors", $this->_notifications);
        Session::instance()->set("notifications", $this->_notifications);
        return $this;
    }

    /**
     * 
     * @param ORM_Validation_Exception $ove
     */
    private function add_orm_validation_exception_errors(ORM_Validation_Exception $ove) {
        foreach ($ove->errors(":model") as $field => $errors) {
            if (Arr::is_array($errors)) {
                foreach ($errors as $error) {
                    $this->_errors[] = Error::factory($field, $error);
                }
            } else {
                $this->_errors[] = Error::factory($field, $errors);
            }
        }
    }

    /**
     * 
     * @param Validation $validation
     */
    private function add_validation_exception_errors(Validation_Exception $validation) {
        foreach ($validation->errors() as $field => $errors) {
            if (Arr::is_array($errors)) {
                foreach ($errors as $error) {
                    if (is_string($error)) {
                        $this->_errors[] = Error::factory($field, $error);
                    }
                }
            } elseif (is_string($error)) {
                $this->_errors[] = Error::factory($field, $error);
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
     * @todo Description
     * @return sting
     */
    public function errors_to_json() {
        return json_encode($this->notifications());
    }

}

?>
