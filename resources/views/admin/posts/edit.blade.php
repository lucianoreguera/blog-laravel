@extends('admin.layout')

@section('header')
    <h1>
        POSTS
        <small>Crear publicación</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        @if ($post->photos->count())
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        @foreach ($post->photos as $photo)
                            <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-xs" style="position: absolute">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <img src="{{ asset('storage/'.$photo->url) }}" class="img-responsive">
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
            @csrf
            @method('PUT')
            <div class="col-md-8">
                <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label>Título publicación</label>
                                <input type="text" name="title" class="form-control" placeholder="Ingresa un título para la publicación" value="{{ old('title', $post->title) }}">
                                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                <label>Contenido publicación</label>
                                <textarea rows="10" name="body" id="editor" class="form-control" placeholder="Ingresa el contenido completo de la publicación">{{ old('body', $post->body) }}</textarea>
                                {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('iframe') ? 'has-error' : '' }}">
                                <label>Contenido embebido (iframe)</label>
                                <textarea rows="2" name="iframe" id="editor" class="form-control" placeholder="Ingresa contenido embebido (iframe) de audio o video">{{ old('iframe', $post->iframe) }}</textarea>
                                {!! $errors->first('iframe', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Fecha de publicación:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="published_at" class="form-control pull-right" id="datepicker" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}">
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label>Categorías</label>
                            <select name="category_id" class="form-control select2">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                            <label>Etiquetas</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Seleciona una o más etiquetas" style="width: 100%;">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label>Extracto publicación</label>
                            <textarea name="excerpt" class="form-control" placeholder="Ingresa un extracto para la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
                            {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css" integrity="sha256-AgL8yEmNfLtCpH+gYp9xqJwiDITGqcwAbI8tCfnY2lw=" crossorigin="anonymous" />
@endpush

@push('scripts')
    <script src="{{ asset('adminlte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js" integrity="sha256-OG/103wXh6XINV06JTPspzNgKNa/jnP1LjPP5Y3XQDY=" crossorigin="anonymous"></script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true
        })
        $('.select2').select2({
            tags: true
        })
        CKEDITOR.replace('editor')
        CKEDITOR.config.height = 315

        var myDropzone = new Dropzone('.dropzone', {
            url: '/admin/posts/{{ $post->url }}/photos',
            paramName: 'photo',
            acceptedFiles: 'image/*',
            maxFilesize: 2,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
        })
        myDropzone.on('error', function(file, res) {
            var msg = res.errors.photo;
            $('.dz-error-message:last > span').text(msg);
        })
        Dropzone.autoDiscover = false
    </script>
@endpush