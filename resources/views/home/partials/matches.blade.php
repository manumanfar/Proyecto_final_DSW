<div class="container-fluid mt-3">
    <div class="row">
        <div class="d-flex justify-content-start align-items-center">
            <i class="fa-solid fa-coins fa-2x text-success"></i>
            <h1 class="mx-2">{{__('Match Betting')}}</h1>
        </div>
        <hr>
        @foreach ($matchWithTeams as $matchAndTeam)
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card border border-1 rounded-2 shadow-lg mb-3">
                <div class="card-header">
                    <h5 class="text-secondary">{{__('Match date')}} {{$matchAndTeam->start_date}}</h5>
                    <hr>
                    <img src="{{$matchAndTeam->image ?? ''}}" width="100%" height="200px">
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start gap-2">
                        <div class="w-50 border border-1 rounded-2 p-2">
                            <h4 class="text-center text-secondary">{{$matchAndTeam->team_local}}</h4>
                            <hr>
                            <div class="d-flex flex-column">
                                <h6 class="text-secondary">{{__('Coach:')}} {{$matchAndTeam->coach_team_local}}</h6>
                                <div class="d-flex justify-content-between">
                                    <p>{{__('Victories')}}</p>
                                    <span class="marcador border border-2 rounded-circle px-2 fs-6">{{__('0')}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>{{__('Defeats')}}</p>
                                    <span class="marcador border border-2 rounded-circle px-2 fs-6">{{__('0')}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>{{__('Goals')}}</p>
                                    <span class="marcador border border-2 rounded-circle px-2 fs-6">{{__('0')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-50 border border-1 rounded-2 p-2">
                            <h4 class="text-center text-secondary">{{$matchAndTeam->team_visitor}}</h4>
                            <hr>
                            <div class="d-flex flex-column">
                                <h6 class="text-secondary">{{__('Coach:')}} {{$matchAndTeam->coach_team_visitor}}</h6>
                                <div class="d-flex justify-content-between">
                                    <p>{{__('Victories')}}</p>
                                    <span class="marcador border border-2 rounded-circle px-2 fs-6">{{__('0')}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>{{__('Defeats')}}</p>
                                    <span class="marcador border border-2 rounded-circle px-2 fs-6">{{__('0')}}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>{{__('Goals')}}</p>
                                    <span class="marcador border border-2 rounded-circle px-2 fs-6">{{__('0')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 w-100">
                        <div class="border border-1 rounded-2 p-2 pt-3 pb-3 d-flex justify-content-between">
                            <p class="m-0">{{__('Number of bets')}} <span class="marcador border border-2 rounded-circle px-2 pt-1 pb-1">{{$matchAndTeam->number_bets ?? 0}}</span></p>
                            <p class="m-0">{{__('Total bets')}} <span class="marcador border border-2 rounded-circle px-2 pt-1 pb-1">{{$matchAndTeam->total_bets ?? 0}}</span></p>
                        </div>
                    </div>
                    <div class="mt-2 w-100 p-2 border border-1 rounded-2">
                        <h4 class="text-center text-secondary">{{__('Marker')}}</h4>
                        <hr>
                        <div class="d-flex justify-content-around gap-2">
                            <div class="marcador border border-2 px-2 rounded-circle d-flex justify-content-center align-items-center">
                                {{$matchAndTeam->result_eq_local ?? 0}}
                            </div>
                            <div class="d-flex justify-content-center align-items-center w-25 text-success">
                                @if($matchAndTeam->result_eq_visitor !== null)
                                {{__('Final')}}
                                @elseif(now() <= $matchAndTeam->start_date)
                                    {{ __('pending')}}
                                    @elseif(now() >= $matchAndTeam->start_date)

                                    {{__('In game')}}
                                    @endif
                            </div>
                            <div class="marcador border border-2 px-2 rounded-circle d-flex justify-content-center align-items-center">
                                {{$matchAndTeam->result_eq_visitor ?? 0}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a class="border border-1 rounded-2 shadow-sm p-1" href="{{route('apuestas', ['idPartido' => $matchAndTeam->id])}}"><i class="fa-solid fa-eye"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>