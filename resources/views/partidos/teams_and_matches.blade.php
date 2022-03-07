@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('flash-message')
    @php
    if($showAddMatch){
    @endphp
    <div class="show-add-team">
        <div class="container-team">
            <form action="/management-create" enctype="multipart/form-data" method="post" enc class="border border-1 shadow-lg rounded-2 p-3">
                {{ csrf_field() }}
                <div class="d-flex justify-content-between">
                    <h4><i class="fa-solid fa-futbol text-success"></i> {{__('Add a new match')}}</h4>
                    <a href="{{route('management')}}"><i class="admin-icon fa-solid fa-circle-xmark fa-2x text-secondary"></i></a>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <div class="form-group">
                        <label class="form-label" for="team-local">{{__('Team local')}}</label>
                        <select id="team-local" class="form-control @error('team_local_id') is-invalid @enderror" name="team_local_id">
                            <option selected disabled>{{__('Choose a team')}}</option>
                            @foreach ($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_local_id') == $team->id ? 'selected' : '' }}>
                                {{ $team->club }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('team_local_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label class="form-label" for="team-visitor">{{__('Team visitor')}}:</label>
                        <select id="team-visitor" class="form-control @error('team_visitor') is-invalid @enderror" name="team_visitor_id">
                            <option selected disabled>{{__('Choose a team')}}</option>
                            @foreach ($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_visitor_id') == $team->id ? 'selected' : '' }}>
                                {{ $team->club }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('team_visitor_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-start gap-2">
                    <div class="mb-3">
                        <label for="date-match-input" class="form-label">{{__('Start date')}}</label>
                        <input type="date" class="form-control @error('date') is-invalid @else is-valid @enderror" id="date-match-input" name="date">
                    </div>
                    <div class="mb-3">
                        <label for="time-match-input" class="form-label">{{__('Start time')}}</label>
                        <input type="time" class="form-control @error('time') is-invalid @else is-valid @enderror" id="time-match-input" name="time">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">{{__('Match image')}}</label>
                        <input class="form-control @error('image') is-invalid @else is-valid @enderror" type="file" id="formFile" name="image">
                    </div>
                </div>
                @error('date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('time')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-dark">{{__('Add Match')}}</button>
                </div>
            </form>
        </div>
    </div>
    @php
    }
    @endphp
    @php
    if($showAddTeam){
    @endphp
    <div class="show-add-team">
        <div class="container-team">
            <form action="/management" method="post" class="border border-1 shadow-lg rounded-2 p-3">
                {{ csrf_field() }}
                <div class="d-flex justify-content-between">
                    <h4><i class="fa-solid fa-futbol text-success"></i> {{__('Add a new team')}}</h4>
                    <a href="{{route('managementShow',['show' => false])}}"><i class="admin-icon fa-solid fa-circle-xmark fa-2x text-secondary"></i></a>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="clubinput" class="form-label">{{__('Club')}}</label>
                    <input type="text" class="form-control @error('club') is-invalid @else is-valid @enderror" id="clubinput" placeholder="{{__('Name Club')}}" name="club">
                </div>
                @error('club')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="mb-3">
                    <label for="coachinput" class="form-label">{{__('Coach')}}</label>
                    <input type="text" class="form-control @error('entrenador') is-invalid @else is-valid @enderror" id="coachinput" placeholder="{{__('Name of the coach')}}" name="entrenador">
                </div>
                @error('entrenador')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-dark">{{__('Add Match')}}</button>
                </div>
            </form>
        </div>
    </div>
    @php
    }
    @endphp
    
    <div class="row">
        <div class="col-12 col-sm-12 col-md-7 col-lg-7">
            @include('partidos.partials.admin_match')
        </div>
        <div class="col-12 col-sm-12 col-md-5 col-lg-5">
            @include('partidos.partials.admin_crud_match')

        </div>

    </div>
</div>
@endsection