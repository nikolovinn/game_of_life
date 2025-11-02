<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\GameOfLife;
use App\GridGenerators\GliderGenerator;
use App\Renderer;

$universeWidth = 25;
$universeHeight = 25;
$numberOfGenerationsToSimulate = 100;
$delayMs = 120;

$grid = new GliderGenerator($universeWidth, $universeHeight)->generate();
$game = new GameOfLife($grid);
$renderer = new Renderer();

for ($i = 0; $i <= $numberOfGenerationsToSimulate; $i++) {

    echo "Conway's Game of Life — Generation {$i}\n";
    $renderer->render($game->getGrid());
    usleep($delayMs * 1000);
    $game = $game->tick();
}
