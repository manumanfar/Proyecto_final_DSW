@php
if($showAddResult && $partId == $matchAndTeam->id){
@endphp
<div class="show-add-team">
    <div class="container-team">
        <form action="/management-update/{{$matchAndTeam->id}}" method="post" class="border border-1 shadow-lg rounded-2 p-3">
            {{ csrf_field() }}
            <div class="d-flex justify-content-between">
                <h4><i class="fa-solid fa-futbol text-success"></i> {{__('Add a final result')}}</h4>
                <a href="{{route('management')}}"><i class="admin-icon fa-solid fa-circle-xmark fa-2x text-secondary"></i></a>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div class="mb-3">
                    <label for="localinput" class="form-label">{{$matchAndTeam->team_local}}</label>
                    <input type="number" class="form-control @error('result_eq_local') is-invalid @else is-valid @enderror" id="localinput" name="result_eq_local">
                </div>
                <div class="mb-3">
                    <label for="visitorinput" class="form-label">{{$matchAndTeam->team_visitor}}</label>
                    <input type="number" class="form-control @error('result_eq_visitor') is-invalid @else is-valid @enderror" id="visitorinput" name="result_eq_visitor">
                </div>
            </div>

            @error('result_eq_visitor')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            @error('result_eq_local')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-dark">{{__('Add Result')}}</button>
            </div>
        </form>
    </div>
</div>
@php
}
@endphp