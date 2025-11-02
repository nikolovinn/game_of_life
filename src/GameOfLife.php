<?php

namespace App;


use App\GridGenerators\GliderGenerator;
use App\Presentation\ConsoleRenderer;
use App\Presentation\Interfaces\Renderer;
use App\Rules\OriginalConwayRule;
use App\Rules\Interfaces\RuleSet;

/**
 * Class representing the Game of Life
 *
 * @author Ivan Nikolov
 */
final class GameOfLife
{
    /**
     * @var int|null
     */
    private int $numberOfGenerationsToSimulate;
    /**
     * @var Grid
     */
    private Grid $grid;
    /**
     * @var RuleSet|OriginalConwayRule
     */
    private RuleSet $ruleSet;
    /**
     * @var Renderer|ConsoleRenderer
     */
    private Renderer $renderer;

    /**
     *
     * @param Grid|null $initialGrid
     * @param RuleSet|null $ruleSet
     * @param int|null $numberOfGenerationsToSimulate
     */
    public function __construct(?Grid $initialGrid = null, ?RuleSet $ruleSet = null, ?Renderer $renderer = null, ?int $numberOfGenerationsToSimulate = 100)
    {
        $this->grid = $initialGrid ?? new GliderGenerator(25, 25)->generate();
        $this->ruleSet = $ruleSet ?? new OriginalConwayRule();
        $this->renderer = $renderer ?? new ConsoleRenderer();
        $this->numberOfGenerationsToSimulate = $numberOfGenerationsToSimulate;
    }

    /**
     * Runs the game
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 0; $i <= $this->numberOfGenerationsToSimulate; $i++) {
            $this->renderer->render($this->grid);
            $this->tick();
        }
    }

    /**
     * Ticks the game of life.
     *
     * @return void
     */
    public function tick(): void
    {
        $this->grid = $this->grid->createNextGeneration($this->ruleSet);
    }

    /**
     * Returns the current grid.
     *
     *
     * @return Grid
     */
    public function getCurrentGrid(): Grid
    {
        return $this->grid;
    }

}
