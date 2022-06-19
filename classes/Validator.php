<?php

class Validator
{
    private $db;
    public $errors = [];

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function checkEmpty($name, $value)
    {
        $name = ucfirst(str_replace("_", " ", $name));
        if (empty($value)) {
            return $this->errors[] = "Введите " . $name;
        } else {
            return false;
        }
    }

    public function checkEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            return $this->errors[] = "Введите корректный email";
        } else {
            return false;
        }
    }


}
