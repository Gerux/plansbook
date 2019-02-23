<?php

namespace App\Controllers;

use App\Models\Routine;
use Core\View;

class RoutinesController
{
    public function index(){
        $routine = new Routine();
        $routines = $routine->getData();
        View::renderTemplate("routines/index.html", [
            'routines' => $routines
        ]);
    }

    public function addRoutine()
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $routine = new Routine($data);
        
        $routine->store();
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/', true, 303);
        exit;
    }

}