<?php

namespace App\Rules\Interfaces;

/**
 * Defines the interface for a rule set.
 *
 * @author Ivan Nikolov
 */
interface RuleSet
{
    public function willBeAlive(bool $isAlive, int $aliveNeighbours): bool;
}