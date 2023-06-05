<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once "src/scoring_bowling/validators/NonNegativeIntValidator.php";

final class NonNegativeIntValidatorTest extends TestCase
{
    public function testIsValid(): void {
        $validator = new NonNegativeIntValidator();
        $this->assertTrue($validator->isValid("0"));
        $this->assertTrue($validator->isValid("5"));
        $this->assertTrue($validator->isValid("10"));
        $this->assertFalse($validator->isValid("-1"));
        $this->assertTrue($validator->isValid("5430"));
        $this->assertTrue($validator->isValid("004"));
        $this->assertFalse($validator->isValid("0.53"));
        $this->assertFalse($validator->isValid("gfsdgfd"));
        $this->assertFalse($validator->isValid("g654"));
    }
}

?>
