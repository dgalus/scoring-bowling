<?php

require_once "scoring_bowling/validators/Validator.php";

/**
 * A validator that checks if a string contains integer value from given range (value >= min and value <= max).
 */
class IntRangeValidator implements Validator
{
    /**
     * Lower limit of validity.
     */
    private int $min;

    /**
     * Upper limit of validity.
     */
    private int $max;

    /**
     * Constructor which sets the lower and upper limits of validity.
     *
     * @param  int $min
     * @param  int $max
     * @return void
     */
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * A method that checks if a string contains integer value from given range.
     *
     * @param  string $value Value to test.
     * @return bool Result of validation. True if valid.
     */
    public function isValid($value): bool
    {
        if(!is_numeric($value)) return false;
        $testedValue = intval($value);
        if (
            is_int($testedValue) &&
            $testedValue >= $this->min &&
            $testedValue <= $this->max
        ) {
            return true;
        }
        return false;
    }
}
?>
