<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Queries\PartidoQueries;
use App\Http\Requests\EquipoForm;
use App\Http\Requests\PartidoForm;
use App\Http\Requests\updatePartidoForm;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showAddTeam = false;
        $showAddMatch = false;
        $showAddResult = false;
        $partId = $request->partId;

        if ($request->show) {
            $showAddTeam = true;
        } else {
            $showAddTeam = false;
        }
        if ($request->showMatch) {
            $showAddMatch = true;
        } else {
            $showAddMatch = false;
        }
        if ($request->showResult) {
            $showAddResult = true;
        } else {
            $showAddResult = false;
        }

        $matchWithTeams = (new PartidoQueries)->getMatchWithTeams();
        $teams = Equipo::get();

        return view('partidos.teams_and_matches', compact('matchWithTeams', 'showAddTeam', 'showAddMatch', 'showAddResult', 'teams', 'partId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PartidoForm $request)
    {
        $resp = (new PartidoQueries)->createMatchWithParticipantes($request);

        if ($resp) {
            return redirect()->route('management')->with('success', 'Match created successfully');
        } else {
            return redirect()->route('management')->with('error', 'Match already exists');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipoForm $request)
    {
        $resp = Equipo::create($request->all());

        if ($resp) {
            return redirect()->route('management')->with('success', 'Team created successfully');
        } else {
            return redirect()->route('management')->with('error', 'Team already exists');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function show(partido $partido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function edit(partido $partido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function update(updatePartidoForm $request, Partido $partido)
    {
        $resp = $partido->update($request->all());
       
        if ($resp) {
            return redirect()->route('management')->with('success', 'Result updated successfully');
        } else {
            return redirect()->route('management')->with('error', 'Error on update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\partido  $partido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partido $partido)
    {
        $resp = $partido->delete();
        if ($resp) {
            return back()->with('success', 'Remove match successfully');
        } else {
            return back()->with('error', 'It is not possible to delete the match');
        }
    }
}
