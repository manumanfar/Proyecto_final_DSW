<?php

namespace App\MyService;

class Price
{
    public function price($total_bets, $winners)
    {
        $betsLess = 0;
        $divisor = 0;
        foreach ($winners as $valuebet){
            foreach($winners as $valuebet2){
                if($valuebet->value_bet >= $valuebet2->value_bet){
                    $betsLess = $valuebet2->value_bet;
                }
            }
        }

        foreach($winners as $key => $valuebet){
            $parteProporcional = (($valuebet->value_bet*100)/$betsLess)/100;
            $winners[$key]->part = $parteProporcional;
            $divisor = $divisor + $parteProporcional;
        }
        if($divisor > 0){
            $totalDivididoProporcional = $total_bets/$divisor;
            foreach($winners as $key => $valueBet){
                $winners[$key]->price = $valueBet->part*$totalDivididoProporcional;
            }
        }
        //dd($winners);
        return $winners;
    }
}
