<?php

/**
 * Interface which defines all necessary methods to communicate with player during gameplay.
 */
interface Ui
{
    /**
     * Sends welcome in game message to player.
     *
     * @return void
     */
    public function printWelcomeMessage(): void;

    /**
     * Sends information about current score to player.
     *
     * @param int $score Current score.
     * @return void
     */
    public function printCurrentScore(int $score): void;

    /**
     * Sends current frame number to player.
     *
     * @param int $frame Current frame number.
     * @return void
     */
    public function printFrameInformation(int $frame): void;

    /**
     * Sends "strike" message to player.
     *
     * @return void
     */
    public function printStrikeMessage(): void;

    /**
     * Sends "spare" message to player.
     *
     * @return void
     */
    public function printSpareMessage(): void;

    /**
     * Sends "game over" message to player.
     *
     * @return void
     */
    public function printGameOverMessage(): void;

    /**
     * Sends gameplay summary to player.
     *
     * @param array<int, Frame> $frames All frames of the game.
     * @return void
     */
    public function printGameplaySummary($frames): void;

    /**
     * Receives from player number of pins knocked down, validated by given validators.
     *
     * @param  array<int, Validator> $validators Validators to check input given by user.
     * @return int Number of pins knocked down.
     */
    public function getPinsKnockedDown(array $validators): int;
}

?>
