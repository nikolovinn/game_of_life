<?php

namespace App\GridGenerators;

use App\Grid;

/**
 * Provides helper methods to seed a 'Glider' pattern
 *
 */
final class BlinkerGenerator extends AbstractGenerator
{
    /**
     * Generates a blinker pattern in the center of a grid
     * with the given dimensions.
     *
     * @return Grid
     */
    public function generate(): Grid
    {
        $gliderPattern = $this->getPattern();
        $startPosition = $this->getStartPositionForCenterPlacement();

        return self::seedAt($this->grid, $startPosition[1], $startPosition[1], $gliderPattern);
    }

    protected function getPattern(): array
    {
        return [
            [0, 0], [0, 1], [0, 2],
        ];
    }
}
