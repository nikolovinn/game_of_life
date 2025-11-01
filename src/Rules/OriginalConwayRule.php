<?php

namespace App\Rules;

use App\Rules\Interfaces\RuleSet;

/**
 * Implements the original Conway's rules.
 *
 * @author Ivan Nikolov
 */
final class OriginalConwayRule implements RuleSet
{
    /**
     * Determines if a cell will be alive based on the Conway's rules.
     *
     * @param bool $isAlive
     * @param int $aliveNeighbours
     * @return bool
     */
    public function willBeAlive(bool $isAlive, int $aliveNeighbours): bool
    {
        return $isAlive ? ($aliveNeighbours === 2 || $aliveNeighbours === 3) : ($aliveNeighbours === 3);
    }
}
