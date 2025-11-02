<?php

namespace Tests\Unit;

use App\Grid;
use App\Rules\OriginalConwayRule;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testCreateEmptyGrid(): void
    {
        $grid = Grid::createEmpty(3, 3);
        $this->assertSame(3, $grid->getWidth());
        $this->assertSame(3, $grid->getHeight());

        $allCells = $grid->getAll();
        foreach ($allCells as $y => $row) {
            foreach ($row as $x => $cell) {
                $this->assertFalse($cell,
                    sprintf("Cell at position (%d,%d) should be dead", $x, $y)
                );
            }
        }
    }

    public function testCreateFromState(): void
    {
        $initialState = [
            [true, false],
            [false, true]
        ];
        $grid = Grid::createFromState($initialState);
        
        $this->assertTrue($grid->get(0, 0));
        $this->assertFalse($grid->get(1, 0));
        $this->assertFalse($grid->get(0, 1));
        $this->assertTrue($grid->get(1, 1));
    }


    public function testWraparound(): void
    {
        $grid = Grid::createFromState([
            [true, false],
            [false, true]
        ]);
        
        $this->assertTrue($grid->get(-2, -2)); // Should wrap to (0,0)
        $this->assertTrue($grid->get(3, 3));   // Should wrap to (1,1)
    }

    public function testNextGeneration(): void
    {
        $initialState = [
            [false, false, false, false, false],
            [false, false, true, false, false],
            [false, false, true, false, false],
            [false, false, true, false, false],
            [false, false, false, false, false]
        ];

        $grid = Grid::createFromState($initialState);
        $nextGen = $grid->createNextGeneration(new OriginalConwayRule());

        $expected = [
            [false, false, false, false, false],
            [false, false, false, false, false],
            [false, true, true, true, false],
            [false, false, false, false, false],
            [false, false, false, false, false]
        ];

        $this->assertSame($expected, $nextGen->getAll());
    }

}