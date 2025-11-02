Conway's Game of Life Implementation

## Overview
This repository contains a PHP implementation of Conway's Game of Life, a cellular automaton that simulates the evolution of a population of cells based on a set of simple rules. The project was developed as a demonstration of software engineering principles, including clean code architecture, SOLID principles, and modern PHP practices.

## Project Description
The Game of Life is played on an infinite two-dimensional grid where cells can be either alive or dead. Each cell's fate is determined by its interaction with its eight neighbors (horizontal, vertical, and diagonal) according to four fundamental rules:

1. A live cell with fewer than two live neighbors dies (underpopulation).
2. A live cell with two or three live neighbors survives.
3. A live cell with more than three live neighbors dies (overcrowding).
4. A dead cell with exactly three live neighbors becomes alive (reproduction).

## Technical Implementation
The project is built using:
- PHP 8.4 CLI
- Docker and Docker Compose for containerization.
- Composer for dependency management.
- PSR-4 autoloading standard.
- Clear separation of concerns.
- Abstract classes and interfaces.
- Immutable objects where appropriate.

### Key Components
- Grid System: Manages the two-dimensional universe of cells
- Rule Engine: Implements Conway's rules for cell evolution, but also open for implementing other rules.
- Pattern Generator: Includes the Glider pattern generator but is open for implementing further patterns.
- Game Engine: Coordinates the game progression.
- Console Renderer: Visualizes the game state.

## Getting Started

### Prerequisites
- Docker and Docker Compose installed on your system.
- Git for cloning the repository.

### Installation and start
1. Clone the repository.
2. Navigate to the project directory.
3. Build and run the Docker container:
    ```bash
    docker compose build
    ```
    ```bash
    docker compose run app
    ```
   
4. Running the tests

   ```bash
    docker compose run -rm test
   ```

### Running without Docker

#### Prerequisites
- PHP 8.4 CLI installed and accessible from command line
- Composer installed (global or local)

#### Installation and Running
1. Clone the repository
2. Navigate to the project directory
3. Install dependencies:
   ```bash
   composer install
   ```
4. Run the simulation:
   ```bash
   php index.php
   ```

5. Running the tests:

   ```bash
   vendor/bin/phpunit tests
   ```
   


### Running the Simulation
The simulation will automatically:
- Create a 25x25 universe
- Place a Glider pattern in the center
- Run for 40 generations
- Display each generation in the console with a small delay
- Basic parameters can be changed in index.php file:

<code>$universeWidth = 25</code>

<code>$universeHeight = 25</code>

<code>$numberOfGenerationsToSimulate = 40</code>

<code>$delayMs = 120</code>

## Future Improvements

- Extend test coverage
- Implement additional rendering options
- Create an interactive mode
- Implement different rules



