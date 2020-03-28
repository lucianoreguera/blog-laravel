@extends('admin.layout')

@section('header')
    <h1>
        ROLES
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Roles</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de roles</h3>
            @can('create', $roles->first())
                <a class="btn btn-primary pull-right" href="{{ route('admin.roles.create') }}">
                    <i class="fa fa-plus"></i> Crear rol
                </a>
            @endcan
        </div>

        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identificador</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->permissions->pluck('display_name')->implode(', ') }}</td>
                            <td>
                                @can('update', $role)
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-xs btn-info">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endcan
                                @can('delete', $role)
                                    @if ($role->id !== 1)
                                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-xs btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este rol?')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('adminlte/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#posts-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endpush