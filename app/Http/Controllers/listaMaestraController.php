<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Project;

class listaMaestraController extends Controller
{
    public function index()
    {
        $projects = Project::get();

        return view('listaMaestra.index', compact('projects'));

    }
}
