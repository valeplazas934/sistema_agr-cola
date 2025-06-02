@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Administrador</h1>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary w-100">Gestionar Usuarios</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.cultivations.index') }}" class="btn btn-success w-100">Gestionar Publicaciones</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-warning w-100">Gestionar Categorías</a>
        </div>
    </div>
</div>
@endsection
