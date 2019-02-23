<?php

namespace App\Controllers;

use Core\View;

class PointsController
{
    public function index()
    {
        View::renderTemplate("home/index.html");
    }
}