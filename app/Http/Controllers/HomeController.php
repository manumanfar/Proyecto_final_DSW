<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\PartidoQueries;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $matchWithTeams = (new PartidoQueries)->getMatchWithTeams();

        return view('home', compact('matchWithTeams'));
    }
}
