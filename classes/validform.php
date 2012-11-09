<?php

/**
 * Utility to validate forms and show notifications.
 */
class ValidForm {

    private static $_instance;

    /**
     *
     * @return ValidForm 
     */
    public static function instance() {
        return ValidForm::$_instance ? ValidForm::$_instance : ValidForm::$_instance = new ValidForm();
    }

    /**
     *
     * @var ORM_Validation_Exception 
     */
    private $_errors;
    private $_notifications = array();

    /**
     * Gère les notifications.
     * @param type $message
     * @param array $variables replacement variables
     * @param type $type alert, error, info, warning
     */
    public function notifications($notification = NULL, array $variables = NULL, $type = "") {

        if ($notification === NULL) {
            // Act as a getter
            return $this->_notifications;
        }

        $this->_notifications[] = new ValidForm_Notification($notification, $variables, $type);
    }

    /**
     * Gère les erreurs de formulaire.
     * @param ORM_Validation_Exception $errors
     * @return type
     */
    public function errors(ORM_Validation_Exception $errors = NULL) {

        if ($errors === NULL) {
            // ACT AS A GETTER
            return $this->_errors;
        }

        if ($this->_errors !== NULL) {
            $this->_errors->merge($errors);
        } else {
            $this->notifications("Les données envoyées sont invalides.", NULL, "error");
            $this->_errors = $errors;
        }
    }

    /**
     *
     * @param ORM_Validation_Exception $errors 
     * @deprecated, user errors instead,
     */
    public function push_errors(ORM_Validation_Exception $errors = NULL) {

        return $this->errors($errors);
    }

    public function has_errors() {
        return count($this->_errors) > 0;
    }

    /**
     * @todo Description
     * @return type
     */
    public function to_json() {

        $error_output = array();

        if ($this->_errors) {
            foreach ($this->_errors->errors(":model") as $key => $value) {
                if (is_string($value)) {
                    $error_output[$key] = __($value);
                }
            }
            return json_encode($error_output);
        }

        return json_encode(array());
    }

    /**
     * @deprecated use to_json.
     * @return String 
     */
    public function retreive_errors() {

        return $this->to_json();
    }

}

?>
