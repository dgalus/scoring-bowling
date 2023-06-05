<?php

require_once "scoring_bowling/validators/Validator.php";

class IntRangeValidator implements Validator
{
    private $min;
    private $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function isValid($value): bool
    {
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
