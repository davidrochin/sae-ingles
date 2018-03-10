<div class="modal fade show" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Cuerpo del Modal -->
                <div class="modal-body">

                    {{ $body or ''}}

                </div>
                <div class="modal-footer">

                    @if(isset($dismiss))
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $dismiss }}</button>
                    @endif
                    
                    {{ $footer or ''}}

                </div>
            </div>
        </div>
    </div>