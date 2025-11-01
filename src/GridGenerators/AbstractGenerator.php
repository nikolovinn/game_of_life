<?php

namespace App\GridGenerators;

use App\Grid;
use App\GridGenerators\Interfaces\GridGenerator;

/**
 * Abstract class for all generators.
 *
 * @author Ivan Nikolov
 */
abstract class AbstractGenerator implements GridGenerator{

    /**
     * Seed a patern in a give grid with a given position.
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
}