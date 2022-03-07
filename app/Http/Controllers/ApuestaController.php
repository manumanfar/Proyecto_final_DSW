<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\PartidoQueries;
use App\Queries\ApuestaQueries;
use App\Http\Requests\ApuestaForm;
use Illuminate\Support\Facades\Auth;
use App\MyService\Facades\Price;
use App\Models\Partido;

class ApuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idPartido = $request->idPartido;
        $apuestasWithUserAndMatches = (new PartidoQueries)->getUserWithMatchAndTeams($idPartido);
        $equipos = (new PartidoQueries)->getTeamsByMacthWithVisitor($idPartido);
        $equipoLocal = $equipos->where('visitor', false);
        $equipoVisitor = $equipos->where('visitor', true);

        $winnerAndMoney = (new ApuestaQueries)->winnersAndMoney($idPartido);
        $totalBets = (new ApuestaQueries)->totalbets($idPartido);
        if(count($totalBets) != 0){
            Price::price($totalBets[0]->total_bets, $winnerAndMoney);
        }
        return view('apuestas.apuestas', compact('apuestasWithUserAndMatches', 'winnerAndMoney','totalBets', 'equipoVisitor', 'equipoLocal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApuestaForm $request)
    {
        $updateOrCreateApuesta = (new ApuestaQueries)->createBetorUpdate(Auth::user()->id, $request->idPartido, $request->all());
        //dd($updateOrCreateApuesta);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        (new ApuestaQueries)->deleteBet($request->user_id,$request->partido_id);
        return back();
    }
}
