@extends('layouts.main')

@section('title', 'Adicionar Nota')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h2 class="fw-bold">
            <ion-icon name="person-add-outline"></ion-icon> Adicionar Nota
        </h2>
        <form action="{{ route('notas.store') }}" method="POST" id="form" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group">
                <label for="xml">Select XML File:</label>
                <input type="file" accept=".xml" class="form-control" id="xml" name="xml" required>
            </div>

            <a class="btn btn-dark" href="{{ route('notas.index') }}">Cancelar</a>
            <input type="submit" class="btn btn-primary" value="Adicionar nota">
        </form>
    </div>
    
    @yield('content')
@endsection
