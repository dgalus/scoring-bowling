<?php

interface Ui
{
    public function printWelcomeMessage(): void;
    public function printCurrentScore(int $score): void;
    public function printFrameInformation(int $frame): void;
    public function printStrikeMessage(): void;
    public function printSpareMessage(): void;
    public function printGameOverMessage(): void;
    public function printGameplaySummary($frames): void;
    public function getPinsKnockedDown(array $validators): int;
}

?>
