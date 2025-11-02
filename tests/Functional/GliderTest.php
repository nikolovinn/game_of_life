<?php

namespace Tests\Functional;

use App\GameOfLife;
use App\GridGenerators\GliderGenerator;
use PHPUnit\Framework\TestCase;

class GliderTest extends TestCase
{
    public function testGliderMovesDiagonally(): void
    {
        $game = new GameOfLife();

        $initialLiveCells = $this->getLiveCellPositions($game->getCurrentGrid());

        for ($i = 0; $i < 4; $i++) {
            $game->tick();
        }

        $newLiveCells = $this->getLiveCellPositions($game->getCurrentGrid());

        $deltaX = $this->calculateDelta($initialLiveCells, $newLiveCells, 0); // x-coordinate
        $deltaY = $this->calculateDelta($initialLiveCells, $newLiveCells, 1); // y-coordinate

        $this->assertEquals(1, $deltaX, "Glider should move 1 step right after 4 generations");
        $this->assertEquals(1, $deltaY, "Glider should move 1 step down after 4 generations");
        $this->assertCount(5, $newLiveCells, "Glider should maintain 5 live cells");
    }

    private function getLiveCellPositions($grid): array
    {
        $positions = [];
        for ($y = 0; $y < $grid->getHeight(); $y++) {
            for ($x = 0; $x < $grid->getWidth(); $x++) {
                if ($grid->get($x, $y)) {
                    $positions[] = [$x, $y];
                }
            }
        }
        return $positions;
    }

    private function calculateDelta(array $initial, array $final, int $coordinate): int
    {
        $initialSum = array_sum(array_column($initial, $coordinate));
        $finalSum = array_sum(array_column($final, $coordinate));
        $initialCount = count($initial);

        return (int)round(($finalSum / $initialCount) - ($initialSum / $initialCount));
    }
}
