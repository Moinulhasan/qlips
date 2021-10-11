<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function topic(){
        return View("pages.topics");
    }

    public function questions(){
        return View("pages.questions");
    }
}
