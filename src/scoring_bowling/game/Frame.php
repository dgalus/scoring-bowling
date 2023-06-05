<?php

require_once "scoring_bowling/game/exceptions/FrameException.php";

/**
 * Class which represents every game stage (each round played by user).
 */
class Frame
{
    /**
     * Pins knocked down by player in each round roll.
     */
    private array $rollsPins = [0, 0, 0];

    /**
     * How many times player rolled in this frame.
     */
    private int $rollsCount = 0;

    /**
     * Bonus points earned by player in this frame.
     */
    private int $bonusPoints = 0;

    /**
     * Is this frame last frame of the game.
     */
    private bool $isLastFrame;

    /**
     * Constructor. Sets variables.
     *
     * @param  bool $isLastFrame
     * @return void
     */
    public function __construct($isLastFrame = false)
    {
        $this->isLastFrame = $isLastFrame;
        $this->bonusPoints = 0;
    }

    /**
     * Getter for $rollsCount variable.
     *
     * @return int Rolls counter.
     */
    public function getRollsCount(): int
    {
        return $this->rollsCount;
    }

    /**
     * Getter for $rollsPins variable.
     *
     * @return array<int, int> Pins knocked down in each roll in frame.
     */
    public function getRollsPins(): array
    {
        return $this->rollsPins;
    }

    /**
     * Sets number of pins knocked down by player in roll.
     * Checks if the player can knock down the given number of pins.
     *
     * @param  int $pins Pins knocked down by player in roll.
     * @throws FrameException
     * @return void
     */
    public function setKnockedDownPins(int $pins): void
    {
        if($pins > 10 || $pins < 0) {
            throw new FrameException(
                "Invalid value."
            );
        }
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
            if ($this->rollsCount >= 2 || $this->rollsPins[0] === 10) {
                throw new FrameException(
                    "Not allowed to roll anymore for this frame."
                );
            } else {
                $this->rollsPins[$this->rollsCount] = $pins;
                $this->rollsCount++;
            }
        }
    }

    /**
     * Checks if player has scored a strike.
     *
     * @return bool True if player knocked down all pins in first roll.
     */
    public function isStrike(): bool
    {
        return $this->rollsPins[0] === 10;
    }

    /**
     * Checks if player has scored a spare.
     *
     * @return bool True if player knocked down all pins in two (first) rolls.
     */
    public function isSpare(): bool
    {
        return $this->rollsPins[0] + $this->rollsPins[1] === 10 &&
            $this->rollsPins[0] != 10;
    }

    /**
     * Getter for $isLastFrame variable.
     *
     * @return bool $isLastFrame
     */
    public function getIsLastFrame(): bool
    {
        return $this->isLastFrame;
    }

    /**
     * Setter for $bonusPoints variable.
     *
     * @param  int $points Bonus points to be set.
     * @return void
     */
    public function setBonusPoints(int $points): void
    {
        $this->bonusPoints = $points;
    }

    /**
     * Getter for $bonusPoints variable.
     *
     * @return int Bonus points earned in this frame.
     */
    public function getBonusPoints(): int
    {
        return $this->bonusPoints;
    }
}

?>
