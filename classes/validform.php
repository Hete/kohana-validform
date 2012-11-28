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
     * @var Validation_Exception
     */
    private $_errors = array();
    private $_notifications = array();

    private function __construct() {
        
    }

    /**
     * Gère les notifications.
     * @param type $message
     * @param array $variables replacement variables
     * @param type $type alert, error, info, warning
     */
    public function notifications($notification = NULL, array $variables = NULL, $type = "") {

        if ($notification === NULL) {
            // Act as a getter

            $notifications = $this->_notifications;
            if (count($this->_errors) > 0) {
                $messages = array();

                foreach ($this->_errors as $errors) {

                    $messages[] = implode(", ", $errors);
                }
                $notifications[] = new ValidForm_Notification("Les erreurs suivantes sont survenues :errors", array(":errors" => implode("; ", $messages)), "error");
            }


            return $notifications;
        }

        $this->_notifications[] = new ValidForm_Notification($notification, $variables, $type);
    }

    /**
     * Gère les erreurs de formulaire.
     * @param ORM_Validation_Exception $errors
     * @return type
     */
    public function errors($errors = NULL) {

        if ($errors === NULL) {
            // ACT AS A GETTER
            return $this->_errors;
        }

        



        if ($errors instanceof ORM_Validation_Exception) {
            foreach ($errors->errors(":model") as $field => $errors) {
                if (Arr::is_array($errors)) {
                    foreach ($errors as $error) {
                        $this->_errors[$field][] = __($error);
                    }
                } else {
                    $this->_errors[$field][] = __($errors);
                }
            }
        } elseif ($errors instanceof Validation) {
            foreach ($errors->errors() as $field => $errors) {
                if (Arr::is_array($errors)) {
                    foreach ($errors as $error) {
                        $this->_errors[$field][] = __($error);
                    }
                } else {
                    $this->_errors[$field][] = __($errors);
                }
            }
        } else {
            throw new Kohana_Exception("Errors supplied must be instance of ORM_Validation_Exception or Validation.");
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
        return json_encode($this->_errors);
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
