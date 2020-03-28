@extends('layout')

@section('content')
<section class="pages container">
    <div class="page page-about">
        <h1 class="text-capitalize">Permiso Denegado</h1>
        <span style="color:red">{{ $exception->getMessage() }}</span>
        <p>
            <a href="{{ url()->previous() }}">Regresar</a>
        </p>
    </div>
</section>
@endsection