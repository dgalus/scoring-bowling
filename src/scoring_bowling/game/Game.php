<?php

require_once "scoring_bowling/game/Frame.php";
require_once "scoring_bowling/game/ui/Cli.php";
require_once "scoring_bowling/validators/NonNegativeIntValidator.php";
require_once "scoring_bowling/validators/IntRangeValidator.php";

/**
 * Game logic class.
 */
class Game
{
    /**
     * Total score earned until now in game.
     */
    private int $score;

    /**
     * Variable to iterate over the frames (game rounds).
     */
    private int $frameIterator;

    /**
     * Frames of the game.
     */
    private array $frames;

    /**
     * Interface to interact with player.
     */
    private Ui $ui;

    /**
     * Constructor. Sets variables, creates frames and user interface.
     *
     * @return void
     */
    function __construct()
    {
        $this->score = 0;
        $this->frameIterator = 0;
        $this->frames = [];
        for ($i = 0; $i < 9; $i++) {
            $this->frames[$i] = new Frame();
        }
        $this->frames[9] = new Frame(($isLastFrame = true));
        $this->ui = new Cli();
    }

    /**
     * Method to start game.
     * Iterates over frames and allows player to perform actions.
     * Contains most of the game logic.
     *
     * @return void
     */
    public function play()
    {
        $this->ui->printWelcomeMessage();

        foreach ($this->frames as &$currentFrame) {
            $this->ui->printFrameInformation($this->frameIterator + 1);

            $validator1 = new NonNegativeIntValidator();
            $validator2 = new IntRangeValidator(0, 10);
            $pins = $this->roll([$validator1, $validator2]);
            $currentFrame->setKnockedDownPins($pins);

            if ($currentFrame->getIsLastFrame()) {
                if ($currentFrame->isStrike()) {
                    $this->ui->printStrikeMessage();
                    $validator2 = new IntRangeValidator(0, 10);
                } else {
                    $validator2 = new IntRangeValidator(0, 10 - $pins);
                }
                $pins = $this->roll([$validator1, $validator2]);
                $currentFrame->setKnockedDownPins($pins);
                if ($pins === 10) {
                    $this->ui->printStrikeMessage();
                }
                if ($currentFrame->isSpare()) {
                    $this->ui->printSpareMessage();
                }

                if ($currentFrame->isSpare() || $pins === 10) {
                    $validator2 = new IntRangeValidator(0, 10);
                    $pins = $this->roll([$validator1, $validator2]);
                    $currentFrame->setKnockedDownPins($pins);
                    if ($pins === 10) {
                        $this->ui->printStrikeMessage();
                    }
                }
            } else {
                if ($currentFrame->isStrike()) {
                    $this->ui->printStrikeMessage();
                } else {
                    $validator2 = new IntRangeValidator(0, 10 - $pins);
                    $pins = $this->roll([$validator1, $validator2]);
                    $currentFrame->setKnockedDownPins($pins);
                    if ($currentFrame->isSpare()) {
                        $this->ui->printSpareMessage();
                    }
                }
            }

            $this->frameIterator++;
            $this->calculateScore();
            $this->ui->printCurrentScore($this->getScore());
        }

        $this->ui->printGameOverMessage();
        $this->ui->printGameplaySummary($this->frames);
    }

    /**
     * Method to calculate player score at current game stage. Saves current player score in $score variable.
     *
     * @return void
     */
    private function calculateScore()
    {
        $this->score = 0;
        for ($i = 0; $i < 9; $i++) {
            $this->frames[$i]->setBonusPoints(0);
            if ($this->frames[$i]->isStrike()) {
                if ($this->frames[$i + 1]->isStrike()) {
                    if ($i + 1 === 9) {
                        $this->frames[$i]->setBonusPoints(
                            $this->frames[$i]->getBonusPoints() +
                                $this->frames[9]->getRollsPins()[0] +
                                $this->frames[9]->getRollsPins()[1]
                        );
                    } else {
                        $this->frames[$i]->setBonusPoints(
                            $this->frames[$i]->getBonusPoints() +
                                $this->frames[$i + 1]->getRollsPins()[0] +
                                $this->frames[$i + 2]->getRollsPins()[0]
                        );
                    }
                } else {
                    $this->frames[$i]->setBonusPoints(
                        $this->frames[$i]->getBonusPoints() +
                            $this->frames[$i + 1]->getRollsPins()[0] +
                            $this->frames[$i + 1]->getRollsPins()[1]
                    );
                }
            } elseif ($this->frames[$i]->isSpare()) {
                if ($i + 1 < 10) {
                    $this->frames[$i]->setBonusPoints(
                        $this->frames[$i]->getBonusPoints() +
                            $this->frames[$i + 1]->getRollsPins()[0]
                    );
                }
            }
            $this->score += $this->frames[$i]->getRollsPins()[0];
            $this->score += $this->frames[$i]->getRollsPins()[1];
            $this->score += $this->frames[$i]->getBonusPoints();
        }
        $this->score += array_sum($this->frames[9]->getRollsPins());
        $this->score += $this->frames[9]->getBonusPoints();
    }

    /**
     * Game roll action.
     *
     * @param  array<int, Validator> $validators Validators for user input.
     * @return int Number of pins knocked down (given by player and validated).
     */
    public function roll(array $validators): int
    {
        # can be private
        return $this->ui->getPinsKnockedDown($validators);
    }

    /**
     * Getter for $score variable.
     *
     * @return int Player score at current game stage.
     */
    public function getScore(): int
    {
        # can be private
        return $this->score;
    }
}

?>
