<?php

/**
 * Interface that defines the methods that make a class a validator.
 */
interface Validator
{
    /**
     * Method that checks whether the given argument matches the given criteria.
     *
     * @param  mixed $value The value to be checked by the validator.
     * @return bool Information about the validity of the value argument.
     */
    public function isValid($value): bool;
}
?>
