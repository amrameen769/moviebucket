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
            $upper = preg_match('@[A-Z]@',$value);
            $spec = preg_match('@[^\w]@',$value);
            if ($upper || $spec || strlen($value) <= 5) {
                array_push($this->errors, "Username should not contain uppercase letters or special characters or whitespaces and should be at least 6 characters long");
            }
        }

        if ($field == "password") {
            $upper = preg_match('@[A-Z]@',$value);
            $lower = preg_match('@[a-z]@',$value);
            $num = preg_match('@[0-9]@',$value);
            $spec = preg_match('@[^\w]@',$value);
            if (!$upper || !$lower || !$num || !$spec || strlen($value) <= 5) {
                array_push($this->errors,"Password should contain at least 1 Uppercase, 1 Lowercase , 1 Number, 1 Special Character and Length needs to be more than 6 characters");
            }
        }

        if($field == "email"){
            if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                array_push($this->errors,"Enter a Valid Email");
            }
        }
    }


}