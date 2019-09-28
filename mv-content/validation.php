<?php

class Validation
{
    private $conn;
    private $errors = array();
    function __construct()
    {
        $conn = new mysqli('127.0.0.1', 'amrameen769', '7025', 'db_moviebucket') or die("Connection Error");
    }

    function validate($formArray)
    {

        if (is_array($formArray) && !empty($formArray)) {
            foreach ($formArray as $field => $value) {
                if ($field == "username") {
                    $this->credentialChecker($field, $value);
                }
                if ($field == "password") {
                    $this->credentialChecker($field, $value);
                }
                if($field == "email"){
                    $this->credentialChecker($field,$value);
                }
            }
        }
        return $this->errors;
    }

    private function credentialChecker($field, $value)
    {
        if ($field == "username") {
            if (strlen($value) <= 5) {
                array_push($this->errors, "Username Length needs to be more than 6 characters");
            }
        }

        if ($field == "password") {
            if (strlen($value) <= 5) {
                array_push($this->errors,"Password Length needs to be more than 6 characters");
            }
        }

        if($field == "email"){
            if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                array_push($this->errors,"Enter a Valid Email");
            }
        }
    }
}