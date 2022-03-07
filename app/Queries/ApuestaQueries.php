<?php

namespace App\Queries;

use App\Models\Apuesta;
use Illuminate\Support\Facades\DB;

class ApuestaQueries
{


    public function createBetorUpdate($idUser, $idPartido, $request)
    {
        //dd($idPartido);
        $apuesta = Apuesta::where([['user_id', $idUser], ['partido_id', $idPartido]])
            ->update(['result_visitor' => $request['result_visitor'], 'result_local' => $request['result_local'], 'value_bet' => $request['value_bet']]);

        if (!$apuesta) {
            $apuesta = Apuesta::create(['user_id' => $idUser, 'partido_id' => $idPartido, 'result_visitor' => $request['result_visitor'], 'result_local' => $request['result_local'], 'value_bet' => $request['value_bet']]);
        }

        return true;
    }

    public function deleteBet($idUser, $idPartido)
    {
        $resp = Apuesta::where([['user_id', $idUser], ['partido_id', $idPartido]])->delete();
        if ($resp) {
            return true;
        }

        return false;
    }

    public function winnersAndMoney($idPartido)
    {
        $betsByMatch = DB::table('apuestas')
        ->join('partidos', function ($join) use($idPartido) {
            $join->on('apuestas.partido_id', '=', 'partidos.id')
                 ->where('partidos.id', '=', $idPartido);
        })
        ->get();
        $UserByBets = DB::Table('users')
            ->join('apuestas', 'users.id', '=', 'apuestas.user_id')
            ->where('apuestas.partido_id', '=', $idPartido)
            ->select('users.name','apuestas.*')
            ->latest('updated_at')
            ->get();
        
        $winnerAndMoney = [];
        foreach ($betsByMatch as $key => $value){
            
            foreach ($UserByBets as $value2){
                
                if($value->user_id == $value2->user_id){
                    
                    if($value->result_visitor == $value->result_eq_visitor && $value->result_local == $value->result_eq_local){
                        
                        $winnerAndMoney[$key] = $value2;
                        
                    }
                }
            }
        }
        
        //dd($winnerAndMoney);
        return $winnerAndMoney;
    }

    public function totalbets($idPartido){
        $totalBets = DB::Table('apuestas')
            ->where('apuestas.partido_id', $idPartido)
            ->select('apuestas.partido_id', DB::raw('SUM(value_bet) as total_bets'))
            ->groupBy('apuestas.partido_id')
            ->get();
        
        return $totalBets;
    }
}
