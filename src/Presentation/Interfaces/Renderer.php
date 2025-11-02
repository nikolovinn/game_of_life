<?php

namespace App\Presentation\Interfaces;

use App\Grid;

/**
 * Defines the interface for a Presentation class.
 *
 * @author Ivan Nikolov
 */
interface Renderer
{
    /**
     * @param Grid $grid
     * @return void
     */
    function render(Grid $grid): void;
}