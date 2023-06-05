<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once "src/scoring_bowling/game/Game.php";

final class GameTest extends TestCase
{
    public function testInitialValues(): void {
        $game = new Game();
        $this->assertEquals($game->getScore(), 0);
    }
}

?>