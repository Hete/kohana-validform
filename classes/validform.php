<?php

class ValidForm {

    private static $_instance;

    /**
     *
     * @return ValidForm 
     */
    public static function instance() {
        return ValidForm::$_instance ? ValidForm::$_instance : ValidForm::$_instance = new ValidForm();
    }

    private function __construct() {
        
    }

    private $_errors;

    public function render() {
        return View::factory('validform/validform')->render();
    }

    /**
     *
     * @param ORM_Validation_Exception $errors 
     */
    public function push_errors($errors) {
        if ($this->_errors) {
            $this->_errors->merge("", $errors);
        } else {

            $this->_errors = $errors;
        }
    }

    /**
     *
     * @return String 
     */
    public function retreive_errors() {

        $error_output = array();
        if ($this->_errors) {
            foreach ($this->_errors->errors(":model") as $key => $value) {
                $error_output[$key] = __($value);
            }
            return json_encode($error_output);
        }




        return json_encode(array());
    }

}

?>
