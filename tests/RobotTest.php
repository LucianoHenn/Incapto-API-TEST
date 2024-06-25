<?php

namespace Tests;

use App\Services\RobotService;

final class RobotTest extends TestCase
{   


    // El endpoint del API debe devolver la posición y dirección final del robot, desde el
    // punto inicial, representado con una pareja de coordenadas y una dirección,
    // separados por dos puntos.
    // Ej: Si el robot se encuentra en la columna 2, fila 3, mirando hacia el oeste, el
    // endpoint devolverá 2:3:W.
    public function testClassConstructor()
    {   

        $service = new RobotService();
        $commands = 'MMRMRR';

        $result = $service->moveRobot($commands);
        
        $this->assertSame($result, '2:3:W');
    }
}
