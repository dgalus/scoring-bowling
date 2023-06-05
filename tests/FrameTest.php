<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once "src/scoring_bowling/game/Frame.php";

final class FrameTest extends TestCase
{
    public function testInitialValues(): void {
        $frame = new Frame();
        $this->assertEquals(0, $frame->getRollsCount());
        $this->assertEquals([0,0,0], $frame->getRollsPins());
        $this->assertFalse($frame->isStrike());
        $this->assertFalse($frame->isSpare());
        $this->assertFalse($frame->getIsLastFrame());
        $this->assertEquals(0, $frame->getBonusPoints());
    }

    public function testKnockingDownPins1(): void {
        $this->expectException(FrameException::class);
        $frame = new Frame();
        $frame->setKnockedDownPins(11);
    }

    public function testKnockingDownPins2(): void {
        $this->expectException(FrameException::class);
        $frame = new Frame();
        $frame->setKnockedDownPins(-4);
    }

    public function testKnockingDownPins3(): void {
        $frame = new Frame();
        $frame->setKnockedDownPins(5);
        $frame->setKnockedDownPins(2);
        $this->assertEquals($frame->getRollsCount(), 2);
        $this->assertEquals($frame->getRollsPins(), [5,2,0]);
        $this->assertFalse($frame->isStrike());
        $this->assertFalse($frame->isSpare());
        $this->assertFalse($frame->getIsLastFrame());
    }

    public function testKnockingDownPins4(): void {
        $this->expectException(FrameException::class);
        $frame = new Frame();
        $frame->setKnockedDownPins(5);
        $frame->setKnockedDownPins(5);
        $frame->setKnockedDownPins(5);
    }

    public function testKnockingDownPins5(): void {
        $this->expectException(FrameException::class);
        $frame = new Frame();
        $frame->setKnockedDownPins(10);
        $frame->setKnockedDownPins(5);
    }

    public function testKnockingDownPins6(): void {
        $this->expectException(FrameException::class);
        $frame = new Frame(true);
        $frame->setKnockedDownPins(10);
        $frame->setKnockedDownPins(5);
        $frame->setKnockedDownPins(5);
    }

    public function testKnockingDownPins7(): void {
        $frame = new Frame(true);
        $frame->setKnockedDownPins(10);
        $frame->setKnockedDownPins(10);
        $frame->setKnockedDownPins(5);
        $this->assertEquals($frame->getRollsPins(), [10, 10, 5]);
    }

    public function testKnockingDownPins8(): void {
        $this->expectException(FrameException::class);
        $frame = new Frame(true);
        $frame->setKnockedDownPins(2);
        $frame->setKnockedDownPins(3);
        $frame->setKnockedDownPins(5);
    }

    public function testIsStrike1(): void {
        $frame = new Frame();
        $frame->setKnockedDownPins(5);
        $this->assertFalse($frame->isStrike());
        $frame->setKnockedDownPins(5);
        $this->assertFalse($frame->isStrike());
    }

    public function testIsStrike2(): void {
        $frame = new Frame();
        $frame->setKnockedDownPins(10);
        $this->assertTrue($frame->isStrike());
    }

    public function testIsSpare1(): void {
        $frame = new Frame();
        $frame->setKnockedDownPins(5);
        $this->assertFalse($frame->isSpare());
        $frame->setKnockedDownPins(5);
        $this->assertTrue($frame->isSpare());
    }

    public function testIsSpare2(): void {
        $frame = new Frame();
        $frame->setKnockedDownPins(10);
        $this->assertFalse($frame->isSpare());
    }


    public function testBonusPoints(): void {
        $frame = new Frame();
        $this->assertEquals($frame->getBonusPoints(), 0);
        $frame->setBonusPoints(10);
        $this->assertEquals($frame->getBonusPoints(), 10);
    }

    public function testGetIsLastFrame(): void {
        $frame = new Frame(true);
        $this->assertTrue($frame->getIsLastFrame());
    }
}

?>