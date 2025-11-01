<?php

namespace App;

use App\Rules\Interfaces\RuleSet;
use InvalidArgumentException;

/**
 * Class representing the game grid
 *
 * @author Ivan Nikolov
 */
final class Grid
{
    /**
     * @var int
     */
    private int $width;
    /**
     * @var int
     */
    private int $height;
    /** @var bool[][] */
    private array $cells;

    /**
     * Creates a new Grid based on the given dimensions and initial state.
     * If an initial state is provided, the dimensions are taken from it and the width and height parameters are ignored.
     * Otherwise, the dimensions are taken from the parameters and a random initial state is generated.
     *
     *
     * @param int $width
     * @param int $height
     * @param array|null $initialState
     * @throws InvalidArgumentException
     */
    private function __construct(int $width, int $height, ?bool $random = false, ?array $initialState = null)
    {
        if ($width <= 0 || $height <= 0) {
            throw new InvalidArgumentException('Grid dimensions must be positive.');
        }

        if ($initialState === null) {
            $initialState = [];
            for ($y = 0; $y < $height; $y++) {
                //If random is true, generate a random initial state.
                //Otherwise, generate empty grid.
                $alive = $random && (bool)rand(0, 1);
                $initialState[$y] = array_fill(0, $width, $alive);
            }

        }

        $this->width = count($initialState);
        $this->height = count($initialState[0]);
        $this->cells = $initialState;
    }

    /**
     * Creates a new randomly generated Grid with the given dimensions.
     *
     * @param int $width
     * @param int $height
     * @return self
     */
    public static function createRandom(int $width, int $height): self
    {
        return new self($width, $height, true);
    }

    /**
     * Creates a new Grid with all cells dead and the given dimensions.
     *
     * @param int $width
     * @param int $height
     * @return self
     */
    public static function createEmpty(int $width, int $height): self
    {
        return new self($width, $height);
    }

    /**
     * Creates a new Grid based on the given state.
     *
     * @param array $cells
     * @return self
     */
    public static function createFromState(array $cells): self
    {
        return new self(count($cells), count($cells[0]), false, $cells);
    }

    /**
     * Returns the width of the grid.
     *
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Returns the height of the grid.
     *
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Return all cells
     *
     * @return bool[][]
     */
    public function getAll(): array
    {
        return $this->cells;
    }

    /**
     * Generates the next generation of the Grid, based on the Conway's rules.
     *
     * @return Grid
     */
    public function createNextGeneration(RuleSet $ruleSet): self
    {
        $nextCells = [];

        for ($y = 0; $y < $this->height; $y++) {
            $nextCells[$y] = [];
            for ($x = 0; $x < $this->width; $x++) {
                $alive = $this->get($x, $y);
                $n = $this->countAliveNeighbours($x, $y);

                $nextCells[$y][$x] = $ruleSet->willBeAlive($alive, $n);
            }
        }

        return self::createFromState($nextCells);
    }

    /**
     * Returns if a cell is alive at the given coordinates.
     *
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function get(int $x, int $y): bool
    {
        if (!$this->inBounds($x, $y)) {
            return false;
        }
        return $this->cells[$y][$x];
    }

    /**
     * Returns true if the given coordinates are within the grid bounds, otherwise false.
     *
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function inBounds(int $x, int $y): bool
    {
        return $x >= 0 && $x < $this->width && $y >= 0 && $y < $this->height;
    }

    /**
     * Returns the number of live neighbors for a given cell.
     *
     * @param int $x
     * @param int $y
     * @return int
     */
    public function countAliveNeighbours(int $x, int $y): int
    {
        $count = 0;
        for ($neighbourY = -1; $neighbourY <= 1; $neighbourY++) {
            for ($neighbourX = -1; $neighbourX <= 1; $neighbourX++) {
                if ($neighbourX === 0 && $neighbourY === 0) continue;
                if ($this->get($x + $neighbourX, $y + $neighbourY)) {
                    $count++;
                }
            }
        }
        return $count;
    }
}
