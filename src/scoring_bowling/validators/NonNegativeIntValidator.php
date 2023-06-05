<?php

require_once "scoring_bowling/validators/Validator.php";

/**
 * A validator that checks if a string contains only a non-negative integer value.
 */
class NonNegativeIntValidator implements Validator
{
    /**
     * Default constructor. Does nothing :)
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * A method that checks if a string contains only a non-negative integer value.
     *
     * @param  string $value Value to test.
     * @return bool Result of validation. True if valid.
     */
    public function isValid($value): bool
    {
        return preg_match("/^[0-9]+$/", $value);
    }
}

?>
