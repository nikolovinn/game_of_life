<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\GameOfLife;
use App\Grid;

$universeWidth   = 25;
$universeHeight  = 25;
$numberOfGenerationsToSimulate    = 40;
$delayMs = 120;

$grid = new Grid($universeWidth, $universeHeight);
$game = new GameOfLife($grid);

for ($i = 0; $i <= $numberOfGenerationsToSimulate; $i++) {

    echo "Conway's Game of Life — Generation {$i}\n";
    usleep($delayMs * 1000);
    $game = $game->tick();
}
