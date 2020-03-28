<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel">
    <form action="{{ route('admin.posts.store', '#create') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="createPostModalLabel">Agrega el título de tu nueva publicación</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        {{-- <label>Título publicación</label> --}}
                        <input id="post-title" type="text" name="title" class="form-control" placeholder="Ingresa un título para la publicación" value="{{ old('title') }}" autofocus required>
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Crear Publicación</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        if (window.location.hash === '#create') {
            $('#createPostModal').modal('show');
        }

        $('#createPostModal').on('hide.bs.modal', () => {
            window.location.hash = '#';
        });

        $('#createPostModal').on('shown.bs.modal', () => {
            $('#post-title').focus();
            window.location.hash = '#create';
        });
    </script>
@endpush