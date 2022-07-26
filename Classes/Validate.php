<?php
namespace clinic;

class Validate {

    public static function minChars(int $length,  string $string = null, $inputVals = [] ) {
        if(count($inputVals) > 0 ){
            foreach($inputVals as $key=>$val) {
                if (strlen($val) < $length) {
                    return false;
                }
            }
            return true;
        }

        if(isset($string)) {
            if (strlen($string) < $length) {
                return false;
            }
        
            return true;    
        }
        
    }

    public static function passwordVerification(string $enteredPassword,string $userPassword) {
        if (password_verify($enteredPassword, $userPassword)) {
            return true;
        }

        return false;
    }

    public static function emailValidation(string $emailField) {
        if (!filter_var($emailField, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function isValueNumeric($val) {
        if (!is_numeric($val)) {
            return false;
        }

        return true;
    }

}