<?php

require_once "scoring_bowling/validators/Validator.php";

class NonNegativeIntValidator implements Validator
{
    public function __construct()
    {
    }

    public function isValid($value): bool
    {
        return preg_match("/^[0-9]+$/", $value);
    }
}

?>
