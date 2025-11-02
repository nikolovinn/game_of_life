<?php

namespace App;


use App\Rules\OriginalConwayRule;
use App\Rules\Interfaces\RuleSet;

/**
 * Class representing the Game of Life
 *
 * @author Ivan Nikolov
 */
final class GameOfLife
{
    private Grid $grid;
    private RuleSet $ruleSet;

    /**
     *
     * @param Grid $grid
     * @param RuleSet|null $ruleSet
     */
    public function __construct(Grid $grid, ?RuleSet $ruleSet = null)
    {
        $this->grid = $grid;
        $this->ruleSet = $ruleSet ?? new OriginalConwayRule();
    }

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
        return new self(
            $this->grid->createNextGeneration($this->ruleSet)
        );
    }
}
