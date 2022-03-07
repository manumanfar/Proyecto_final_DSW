<div class="d-flex flex-column p-2">
    <h4>{{__('Bettors of the match')}} {{$equipoLocal[0]->club}} {{__('VS')}} {{$equipoVisitor[1]->club}}</h4>
    <hr>
    @foreach($apuestasWithUserAndMatches as $betUserAndMatch)

    <div class="d-flex justify-content-between border border-1 rounded-2 shadow-sm mb-2 p-2">
        <span class="name w-25"><i class="fa-solid fa-futbol text-success"></i> {{$betUserAndMatch->name}}</span>
        <span class="result"><i class="fa-solid fa-bullseye text-danger"></i> {{$betUserAndMatch->result_local}}</span>
        <span class="result"><i class="fa-solid fa-bullseye text-info"></i> {{$betUserAndMatch->result_visitor}}</span>
        <span class="value-bet"><i class="fa-solid fa-money-bill-1-wave text-success"></i> {{$betUserAndMatch->value_bet}}€</span>
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-delete" class="delete p-1 border border-1 rounded-2 px-2" {{Auth::User()->admin == '1' || Auth::check() && Auth::User()->id == $betUserAndMatch->user_id ? '': 'disabled' }}><i class="fa-solid fa-trash-arrow-up {{Auth::User()->admin == '1' || Auth::check() && Auth::User()->id == $betUserAndMatch->user_id ? 'text-danger' : 'text-secondary' }}"></i></button>
    </div>
    @include('modal.modal')
    @endforeach
    
    <div class="d-flex flex-column p-2 border border-1 rounded-2 shadow-sm">
        <div class="d-flex justify-content-between">
            <h5>{{__('Total bets')}}</h5>
            <span><i class="fa-solid fa-money-bill-1-wave text-success"></i> {{$totalBets[0]->total_bets ?? ''}}€</span>
        </div>
        <hr>
        <div class="d-flex justify-content-center">
            <h5>{{__('Winners')}}</h5>
        </div>
        <hr>
        @foreach($winnerAndMoney as $winner)
        <div class="d-flex justify-content-between p-2">
            <span><i class="fa-solid fa-face-surprise text-warning"></i> {{$winner->name}}</span>
            <span><i class="fa-solid fa-hand-holding-dollar text-success"></i> {{$winner->price}}€</span>
        </div>
        @endforeach
    </div>

</div>