@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-8">
            @include('apuestas.partials.bets_users')
            @if(count($apuestasWithUserAndMatches) === 0)
            <h4>{{__('There are no bettors')}}</h4>
            @else
            {{$apuestasWithUserAndMatches->appends($_GET)->links()}}
            @endif


        </div>
        <div class="col-4">
            @include('apuestas.partials.bets_add')

        </div>
    </div>
</div>

@endsection