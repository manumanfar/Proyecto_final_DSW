<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Apuesta;
use App\Models\Participante;
use App\Http\Requests\PartidoForm;

class PartidoQueries
{

    public function getUserWithMatchAndTeams($idPartido)
    {
        $usersWithMatch = DB::Table('users')
            ->join('apuestas', 'users.id', '=', 'apuestas.user_id')
            ->join('partidos', 'apuestas.partido_id', '=', 'partidos.id')
            ->where('partidos.id', $idPartido)
            ->select('users.name', 'apuestas.*', 'partidos.*')
            ->latest('updated_at')->paginate(5);

        $partidosWithTeams = DB::Table('equipos')
            ->join('participantes', 'participantes.equipo_id', '=', 'equipos.id')
            ->select('equipos.club', 'equipos.entrenador', 'participantes.*')
            ->get();

        //$usersWithMatchAndTeams = [];

        foreach ($usersWithMatch as $key => $value) {
            //$usersWithMatchAndTeams[$key] = $value;
            foreach ($partidosWithTeams as $key2 => $value2) {

                if ($value->partido_id === $value2->partido_id) {
                    if ($value2->visitor === 0) {
                        $usersWithMatch[$key]->team_local = $value2->club;
                    } else {
                        $usersWithMatch[$key]->team_visitor = $value2->club;
                    }
                }
            }
        }
        //dd($usersWithMatch);

        return $usersWithMatch;
    }

    public function getMatchWithTeams()
    {
        $partidosWithTeamsInOne = [];
        $numberBets = DB::Table('apuestas')
            ->select('apuestas.partido_id', DB::raw('count(user_id) as number_bets'))
            ->groupBy('apuestas.partido_id')
            ->get();
        $totalBets = DB::Table('apuestas')
            ->select('apuestas.partido_id', DB::raw('SUM(value_bet) as total_bets'))
            ->groupBy('apuestas.partido_id')
            ->get();
        //dd($totalBets);
        $onlyMatches = Partido::latest('updated_at')->get();
        $participantesWithTeams = DB::Table('equipos')
            ->join('participantes', 'participantes.equipo_id', '=', 'equipos.id')
            ->select('equipos.club', 'equipos.entrenador', 'participantes.*')
            ->latest('updated_at')
            ->get();

        foreach ($onlyMatches as $key => $value) {

            $partidosWithTeamsInOne[$key] = $value;

            foreach ($participantesWithTeams as $value2) {
                if ($value->id === $value2->partido_id) {
                    if ($value2->visitor === 0) {
                        $partidosWithTeamsInOne[$key]->coach_team_local = $value2->entrenador;
                        $partidosWithTeamsInOne[$key]->team_local = $value2->club;
                    } else {
                        $partidosWithTeamsInOne[$key]->team_visitor = $value2->club;
                        $partidosWithTeamsInOne[$key]->coach_team_visitor = $value2->entrenador;
                    }
                }
            }
        }

        foreach ($partidosWithTeamsInOne as $key => $value) {
            foreach ($numberBets as $value2) {
                if ($value->id === $value2->partido_id) {
                    $partidosWithTeamsInOne[$key]->number_bets = $value2->number_bets;
                }
            }
        }
        foreach ($partidosWithTeamsInOne as $key => $value) {
            foreach ($totalBets as $value2) {
                if ($value->id === $value2->partido_id) {
                    $partidosWithTeamsInOne[$key]->total_bets = $value2->total_bets;
                }
            }
        }
        //dd($partidosWithTeamsInOne);
        return $partidosWithTeamsInOne;
    }

    public function createMatchWithParticipantes(PartidoForm $request)
    {

        $dateTime = $request->date . ' ' . $request->time;
        $partido = Partido::create(['start_date' => $dateTime]);

        if ($partido) {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {


                $partido->image = asset('storage/' . $request->file('image')->hashName());
                $resp = $partido->save();

                $request->file('image')->store('public');

                if ($resp) {
                    Participante::create(['partido_id' => $partido->id, 'equipo_id' => $request->team_local_id, 'visitor' => false]);
                    Participante::create(['partido_id' => $partido->id, 'equipo_id' => $request->team_visitor_id, 'visitor' => true]);
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getTeamsByMacthWithVisitor($idPartido)
    {
        $partidosWithTeams = DB::Table('equipos')
            ->join('participantes', 'participantes.equipo_id', '=', 'equipos.id')
            ->where('participantes.partido_id', $idPartido)
            ->select('equipos.club', 'equipos.entrenador', 'participantes.*')
            ->get();
        //dd($partidosWithTeams);
        return $partidosWithTeams;
    }
}
