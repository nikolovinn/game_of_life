<?php

namespace App;

/**
 * Class responsible for drawing a grid to the console.
 *
 * @author Ivan Nikolov
 */
final class Renderer
{
    /**
     * @var string
     */
    private readonly string $aliveRepresentation;
    /**
     * @var string
     */
    private readonly string $deadRepresentation;

    /**
     * @param string $aliveRepresentation
     * @param string $deadRepresentation
     */
    public function __construct(
        string $aliveRepresentation = "■",
        string $deadRepresentation = "·"
    )
    {
        $this->aliveRepresentation = $aliveRepresentation;
        $this->deadRepresentation = $deadRepresentation;
    }

    /**
     * Renders the current grid state to the console.
     *
     * @param Grid $grid
     * @return void
     */
    public function render(Grid $grid): void
    {
        $gridWidth = $grid->getWidth();
        $gridHeight = $grid->getHeight();

        for ($x = 0; $x < $gridHeight; $x++) {
            $line = '';
            for ($y = 0; $y < $gridWidth; $y++) {
                $line .= $grid->get($y, $x) ? $this->aliveRepresentation : $this->deadRepresentation;
            }
            echo $line, PHP_EOL;
        }
    }
}
