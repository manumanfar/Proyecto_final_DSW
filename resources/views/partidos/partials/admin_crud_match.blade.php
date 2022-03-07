<div class="container-fluid h-100">
    <div class="d-flex flex-column border-start border-1 p-3 h-100">
        <div class="input-group w-100">
            <div class="form-floating w-75">
                <input id="search-focus" type="search" id="form1" class="form-control" />
                <label class="form-label" for="form1">{{__('Search')}}</label>
            </div>
            <button type="button" class="btn btn-info w-25">
                <i class="fas fa-search text-white"></i>
            </button>
        </div>
        <hr>
        <div class="d-flex justify-content-start">
            <a href="{{route('managementShowAddMatch',['showMatch' => true])}}"><i class="admin-icon fa-solid fa-circle-plus fa-2x text-info"></i></a>
            <h4 class="mx-2">{{__('Add match')}}</h4>
        </div>
        <hr>
        <div class="d-flex justify-content-start">
            <a href="{{route('managementShow',['show' => true])}}"><i class="admin-icon fa-solid fa-circle-plus fa-2x text-success"></i></a>
            <h4 class="mx-2">{{__('Add team')}}</h4>
        </div>
        <hr>
    </div>
</div>