<div class="border-start border-1 p-2 h-100">
    <div class="content-add p-2 d-flex flex-column">
        <div class="title-add d-flex justify-content-start">
            <i class="fa-solid fa-circle-plus fa-2x"></i>
            <h4 class="mx-2">{{__('Add or update bet')}}</h4>
        </div>
        <hr>
        <form action="/apuestas/{{$equipoLocal[0]->partido_id}}" method="post">
            {{ csrf_field() }}
            <div class="d-flex justify-content-start">
                <div class="w-50 d-flex flex-column">
                    <label for="input-team-local"><i class="fa-solid fa-bullseye text-danger"></i> {{$equipoLocal[0]->club}}</label>
                    <input type="number" id="input-team-local" class="w-75 @error('result_local') is-invalid @else is-valid @enderror" name="result_local">
                </div>
                <div class="w-50 d-flex flex-column">
                    <label for="input-team-visitor"><i class="fa-solid fa-bullseye text-info"></i> {{$equipoVisitor[1]->club}}</label>
                    <input type="number" id="input-team-visitor" class="w-75 @error('result_visitor') is-invalid @else is-valid @enderror" name="result_visitor">
                </div>
            </div>
            @error('result_local')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('result_visitor')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <hr>
            <div class="w-100 d-flex">
                <label class="w-50" for="input-value-bet"><i class="fa-solid fa-money-bill-1-wave text-success"></i> {{__('Value bet')}}</label>
                <input type="number" id="input-value-bet" class="w-25 @error('value_bet') is-invalid @else is-valid @enderror" name="value_bet">
            </div>
            @error('value_bet')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <hr>
            <button type="submit" class="btn btn-outline-dark">bet</button>
        </form>

    </div>
</div>