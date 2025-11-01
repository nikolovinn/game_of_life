<?php

namespace App\GridGenerators\Interfaces;

use App\Grid;

/**
 * Defines the interface for a rule set.
 *
 * @author Ivan Nikolov
 */
interface GridGenerator
{
    public function generate(int $width, int $height): Grid;
}