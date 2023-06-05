<?php

require_once "scoring_bowling/game/ui/Ui.php";

/**
 * Command Line User Interface class.
 *
 */
class Cli implements Ui
{
    /**
     * Constructor for Cli class.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Prints "Welcome in scoring bowling game" message to stdout.
     *
     * @return void
     */
    public function printWelcomeMessage(): void
    {
        fwrite(STDOUT, "Welcome in scoring bowling game!\n");
    }

    /**
     * Prints current score information to stdout.
     *
     * @param  int $score Current score.
     * @return void
     */
    public function printCurrentScore(int $score): void
    {
        fwrite(STDOUT, "Current score: " . $score . "\n");
    }

    /**
     * Prints to stdout information with frame number.
     *
     * @param  int $frame Frame number.
     * @return void
     */
    public function printFrameInformation(int $frame): void
    {
        fwrite(STDOUT, "Frame " . $frame . "\n");
    }

    /**
     * Prints to stdout "strike" message.
     *
     * @return void
     */
    public function printStrikeMessage(): void
    {
        fwrite(STDOUT, "Strike!\n");
    }

    /**
     * Prints to stdout "spare" message.
     *
     * @return void
     */
    public function printSpareMessage(): void
    {
        fwrite(STDOUT, "Spare!\n");
    }

    /**
     * Prints to stdout "game over" message.
     *
     * @return void
     */
    public function printGameOverMessage(): void
    {
        fwrite(STDOUT, "\nGame over!\n");
    }

    /**
     * Calculates and prints to stdout gameplay statistics (points earned in each round and total score after each round) in tables.
     *
     * @param  array<int, Frame> $frames Array of frames.
     * @return void
     */
    public function printGameplaySummary($frames): void
    {
        fwrite(STDOUT, "\nPoints in each round:\n");
        $pointsInEachRound = "|";
        for ($i = 0; $i < count($frames); $i++) {
            $sum =
                array_sum($frames[$i]->getRollsPins()) +
                $frames[$i]->getBonusPoints();
            $pointsInEachRound .= " " . $sum . " |";
        }
        $len = strlen($pointsInEachRound);
        fwrite(STDOUT, str_repeat("-", $len) . "\n");
        fwrite(STDOUT, $pointsInEachRound);
        fwrite(STDOUT, "\n" . str_repeat("-", $len) . "\n");

        fwrite(STDOUT, "\nSum of points after each round:\n");
        $pointsAfterEachRound = "|";
        $sum = 0;
        for ($i = 0; $i < count($frames); $i++) {
            $sum +=
                array_sum($frames[$i]->getRollsPins()) +
                $frames[$i]->getBonusPoints();
            $pointsAfterEachRound .= " " . $sum . " |";
        }
        $len = strlen($pointsAfterEachRound);
        fwrite(STDOUT, str_repeat("-", $len) . "\n");
        fwrite(STDOUT, $pointsAfterEachRound);
        fwrite(STDOUT, "\n" . str_repeat("-", $len) . "\n");
    }

    /**
     * Get from user number of pins knocked down in each roll.
     * Validates user input using validators given in $validators.
     * Ask user for number of knocked down pins, until the number is not valid.
     *
     * @param  array<int, Validator> $validators Array of validators.
     * @return int Pins knocked down.
     */
    public function getPinsKnockedDown(array $validators): int
    {
        $pins = -1;
        $firstRun = true;
        $pinsStr = "";
        $isValid = true;
        fwrite(STDOUT, "How man pins were knocked down? ");
        do {
            if (!$firstRun) {
                fwrite(STDOUT, "Invalid input. Try again. ");
            }
            $isValid = true;
            fscanf(STDIN, "%s\n", $pinsStr);
            $firstRun = false;
            $isValid = true;
            foreach ($validators as $validator) {
                if (!$validator->isValid($pinsStr)) {
                    $isValid = false;
                    break;
                }
            }
            $pins = intval($pinsStr);
        } while (!$isValid);
        return $pins;
    }
}

?>
