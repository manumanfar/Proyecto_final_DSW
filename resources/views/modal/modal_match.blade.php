<!-- Modal -->
<div class="modal fade" id="modal-delete-match" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Delete match')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                <i class="fa-solid fa-trash-can fa-5x text-danger"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <a href="{{route('delete_match', $matchAndTeam->id)}}" class="btn btn-primary">{{__('Delete match')}}</a>
            </div>
        </div>
    </div>
</div>