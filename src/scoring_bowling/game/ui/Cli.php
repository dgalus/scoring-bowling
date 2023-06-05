<?php

require_once "scoring_bowling/game/ui/Ui.php";

class Cli implements Ui
{
    public function __construct()
    {
    }

    public function printWelcomeMessage(): void
    {
        fwrite(STDOUT, "Welcome in scoring bowling game!\n");
    }

    public function printCurrentScore(int $score): void
    {
        fwrite(STDOUT, "Current score: " . $score . "\n");
    }

    public function printFrameInformation(int $frame): void
    {
        fwrite(STDOUT, "Frame " . $frame . "\n");
    }

    public function printStrikeMessage(): void
    {
        fwrite(STDOUT, "Strike!\n");
    }

    public function printSpareMessage(): void
    {
        fwrite(STDOUT, "Spare!\n");
    }

    public function printGameOverMessage(): void
    {
        fwrite(STDOUT, "\nGame over!\n");
    }

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
