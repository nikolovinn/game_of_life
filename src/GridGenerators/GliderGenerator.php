<?php

namespace App\GridGenerators;

use App\Grid;

/**
 * Provides helper methods to seed a 'Glider' pattern
 *
 */
final class GliderGenerator extends AbstractGenerator
{

    /**
     * Generates a glider pattern in the center of a grid
     * with the given dimensions.
     *
     * @param int $width
     * @param int $height
     * @return bool
     */
    public function generate(int $width, int $height): Grid
    {
        $grid = Grid::createEmpty($width, $height);

        //TO DO: calculate the center by the patten size.
        $x = intdiv($grid->getWidth() - 3, 2);
        $y = intdiv($grid->getHeight() - 3, 2);

        $gliderPattern = [
            [1, 0],
            [2, 1],
            [0, 2], [1, 2], [2, 2],
        ];

        return self::seedAt($grid, $x, $y, $gliderPattern);
    }
}
