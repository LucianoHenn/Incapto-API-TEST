<?php

namespace App\Services;

use Log;

class RobotService
{
    private $gridSize = 10;
    private $robotPosition;
    private $robotDirectionIndex;
    private $directions = ['N', 'E', 'S', 'W'];
    private $simplifyCommand = true;

    public function moveRobot($commands)
    {

        $this->robotPosition = [0, 0];
        $this->robotDirectionIndex = 0;

        if ($this->simplifyCommand) {
            $commands = $this->simplyfyCommands($commands);
        }

        $this->logGrid($this->robotPosition[0], $this->robotPosition[1], $this->directions[$this->robotDirectionIndex]);

        for ($i = 0; $i < strlen($commands); $i++) {

            if ($commands[$i] === "R") {
                $this->turnRight();
            } elseif ($commands[$i] === "L") {
                $this->turnLeft();
            } else {
                $this->moveForward();
            }

            $this->logGrid($this->robotPosition[0], $this->robotPosition[1], $this->directions[$this->robotDirectionIndex]);
        }

        $x = $this->robotPosition[0] + 1;
        $y =  $this->robotPosition[1] + 1;
        return $x . ':' . $y . ':' . $this->directions[$this->robotDirectionIndex];
    }

    private function turnRight()
    {
        $this->robotDirectionIndex++;

        if ($this->robotDirectionIndex > 3)
            $this->robotDirectionIndex = 0;
    }

    private function turnLeft()
    {
        $this->robotDirectionIndex--;

        if ($this->robotDirectionIndex < 0)
            $this->robotDirectionIndex = 3;
    }

    private function moveForward()
    {
        switch ($this->directions[$this->robotDirectionIndex]) {
            case "N":
                $this->robotPosition[1]++;
                if ($this->robotPosition[1] === $this->gridSize) {
                    $this->robotPosition[1] = 0;
                }
                break;
            case "E":
                $this->robotPosition[0]++;
                if ($this->robotPosition[0] === $this->gridSize) {
                    $this->robotPosition[0] = 0;
                }
                break;
            case "S":
                $this->robotPosition[1]--;
                if ($this->robotPosition[1] < 0) {
                    $this->robotPosition[1] = $this->gridSize - 1;
                }
                break;
            default:
                $this->robotPosition[0]--;
                if ($this->robotPosition[0] < 0) {
                    $this->robotPosition[0] = $this->gridSize - 1;
                }
        }
    }

    private function simplyfyCommands($commands)
    {

        $simplifiedCommands = "";
        $lastCount = 0;
        for ($i = 0; $i < strlen($commands); $i++) {

            if ($commands[$i] === "M") {

                if ($lastCount > 0) {
                    $simplifiedCommands .= str_repeat('R', $lastCount % 4);
                } elseif ($lastCount < 0) {
                    $simplifiedCommands .= str_repeat('L', abs($lastCount) % 4);
                }
                $lastCount = 0;
                $simplifiedCommands .= "M";
            } else {
                if ($commands[$i] === "R") {
                    $lastCount++;
                } else {
                    $lastCount--;
                }
            }
        }

        if ($lastCount > 0) {
            $simplifiedCommands .= str_repeat('R', $lastCount % 4);
        } elseif ($lastCount < 0) {
            $simplifiedCommands .= str_repeat('L', abs($lastCount) % 4);
        }

        return $simplifiedCommands;
    }

    private function logGrid($x, $y, $direction)
    {
        $grid = array_fill(0, $this->gridSize, array_fill(0, $this->gridSize, '.'));

        // Mark the robot's position and direction
        $grid[$y][$x] = $direction;

        // Convert grid to string for logging
        $gridString = '';
        for ($i = $this->gridSize - 1; $i >= 0; $i--) {
            $gridString .= implode(' ', $grid[$i]) . "\n";
        }

        Log::info("\n" . $gridString);
    }
}
