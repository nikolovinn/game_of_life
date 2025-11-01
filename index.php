<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\GameOfLife;
use App\Grid;
use App\Renderer;

$universeWidth   = 25;
$universeHeight  = 25;
$numberOfGenerationsToSimulate    = 40;
$delayMs = 120;

$grid = Grid::createRandom($universeWidth, $universeHeight);
$game = new GameOfLife($grid);
$renderer = new Renderer();

for ($i = 0; $i <= $numberOfGenerationsToSimulate; $i++) {

    echo "Conway's Game of Life — Generation {$i}\n";
    $renderer->render($game->getGrid());
    usleep($delayMs * 1000);
    $game = $game->tick();
}
