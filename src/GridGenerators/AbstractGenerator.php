<?php

namespace App\GridGenerators;

use App\Grid;

/**
 * Abstract class for all generators.
 *
 * @author Ivan Nikolov
 */
abstract class AbstractGenerator
{
    protected Grid $grid;

    public function __construct(int $width, int $height)
    {
        $this->grid = Grid::createEmpty($width, $height);
    }

    /**
     * Seed a pattern in a give grid with a given position.
     *
     * @param Grid $grid
     * @param int $x
     * @param int $y
     * @param $pattern
     * @return Grid
     */
    protected function seedAt(Grid $grid, int $x, int $y, $pattern): Grid
    {
        $cells = $grid->getAll();

        foreach ($pattern as [$dx, $dy]) {
            $nx = $x + $dx;
            $ny = $y + $dy;
            if ($grid->inBounds($nx, $ny)) {
                $cells[$ny][$nx] = true;
            }
        }

        return Grid::createFromState($cells);
    }

    /**
     * Return the start coordinates for center placement.
     *
     *
     * @return int[]
     */
    protected function getStartPositionForCenterPlacement(): array
    {
        $pattern = $this->getPattern();

        $xs = array_column($pattern, 0);
        $ys = array_column($pattern, 1);

        $maxWidth  = max($xs) - min($xs) + 1;
        $maxHeight = max($ys) - min($ys) + 1;

        $startX = intdiv($this->grid->getWidth() - $maxWidth, 2);
        $startY = intdiv($this->grid->getHeight() - $maxWidth, 2);

        return [$startX, $startY];
    }

    /**
     * Returns the pattern to be used for seeding.
     *
     *
     * @return array
     */
    abstract protected function getPattern(): array;

    /**
     * Generates the grid.
     *
     * @param int $width
     * @param int $height
     * @return Grid
     */
    abstract public function generate():Grid;



}