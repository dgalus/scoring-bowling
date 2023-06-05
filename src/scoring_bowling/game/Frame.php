<?php

require_once "scoring_bowling/game/exceptions/FrameException.php";

class Frame
{
    private array $rollsPins = [0, 0, 0];
    private int $rollsCount = 0;
    private int $bonusPoints = 0;
    private bool $isLastFrame;

    public function __construct($isLastFrame = false)
    {
        $this->isLastFrame = $isLastFrame;
        $this->bonusPoints = 0;
    }

    public function getRollsCount(): int
    {
        return $this->rollsCount;
    }

    public function getRollsPins(): array
    {
        return $this->rollsPins;
    }

    public function setKnockedDownPins(int $pins): void
    {
        if ($this->isLastFrame) {
            if ($this->rollsCount < 2) {
                $this->rollsPins[$this->rollsCount] = $pins;
                $this->rollsCount++;
            } else {
                if (
                    ($this->rollsPins[0] + $this->rollsPins[1] === 10 ||
                        $this->rollsPins[1] === 10) &&
                    $this->rollsCount === 2
                ) {
                    $this->rollsPins[$this->rollsCount] = $pins;
                    $this->rollsCount++;
                } else {
                    throw new FrameException(
                        "Not allowed to roll anymore for this frame."
                    );
                }
            }
        } else {
            if ($this->rollsCount < 2 && $this->rollsPins[0] === 10) {
                throw new FrameException(
                    "Not allowed to roll anymore for this frame."
                );
            } else {
                $this->rollsPins[$this->rollsCount] = $pins;
                $this->rollsCount++;
            }
        }
    }

    public function isStrike(): bool
    {
        return $this->rollsPins[0] === 10;
    }

    public function isSpare(): bool
    {
        return $this->rollsPins[0] + $this->rollsPins[1] === 10 &&
            $this->rollsPins[0] != 10;
    }

    public function getIsLastFrame(): bool
    {
        return $this->isLastFrame;
    }

    public function setBonusPoints(int $points): void
    {
        $this->bonusPoints = $points;
    }

    public function getBonusPoints(): int
    {
        return $this->bonusPoints;
    }
}

?>
