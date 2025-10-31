<?php

namespace App;

/**
 * Class representing the Game of Life
 *
 * @author Ivan Nikolov
 */
final class GameOfLife
{
    /**
     *
     * @param Grid $grid
     */
    public function __construct(private Grid $grid) {}

    /**
     * Returns the current grid state.
     *
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return $this->grid;
    }

    /**
     * Ticks the game of life.
     *
     * @return self
     */
    public function tick(): self
    {
        return new self($this->grid->createNextGeneration());
    }
}
