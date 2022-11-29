<div class="modal fade gen__modal events-modal" id="event-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="genMdal__header mb-3">                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="genMdal__body">
                <div class="text-center">
                    <img class="full-img" src="{{ $event->renderImagePath() }}">
                </div>
                {{-- <div class="page-bg--16 mb-4">
                    <div class="page-bg page-bg--cover" style="background-image: url('{{ $event->renderImagePath() }}')"></div>
                </div> --}}
                <h3 class="type-2 fntwght--bold mb-4">{{ $event->name }}</h3>
                <div class="modal__desc scroll-custom">
                    <description description="{{ $event->content }}"></description>
                </div>
            </div>
        </div>
    </div>
</div>