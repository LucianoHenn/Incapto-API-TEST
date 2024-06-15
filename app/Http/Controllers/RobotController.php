<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RobotService;
use App\Rules\ValidCommands;


class RobotController extends Controller
{

    protected $robotService;

    public function __construct(RobotService $robotService)
    {
        $this->robotService = $robotService;
    }

    public function move(Request $request)
    {
        
        $request->validate([
            'commands' => ['required', 'string', new ValidCommands(),],

        ]);


        $commands = $request->input('commands');
        $result = $this->robotService->moveRobot($commands);

        return response()->json(['final-robot-position' => $result]);

    }

}
