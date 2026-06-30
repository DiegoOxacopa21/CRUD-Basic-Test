@extends('layouts.master')

@section('pageTitle', 'Students List')

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6">Lista de Estudiantes</h1>
        {{-- <a href="{{ route('students.create') }}" class="btn btn-primary" >Crear Estudiante</a> --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            Crear Estudiante
        </button>
    </div>
    
    <p class="text-muted">La presente tabla muestra a todos los estudiantes registrados y ciertas acciones opcionales a realizar</p>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Codigo Estudiante</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Correo Electronico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$student->codigo}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->surname}}</td>
                            <td>{{$student->age}}</td>
                            <td>{{$student->email}}</td>
                            <td>
                                <div class="btn-group">
                                    {{-- <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">Detalles</a> --}}
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"
                                        data-id="{{ $student->id }}"
                                        data-codigo="{{ $student->codigo }}"
                                        data-name="{{ $student->name }}"
                                        data-surname="{{ $student->surname }}"
                                        data-age="{{$student->age}}"
                                        data-email="{{ $student->email }}">
                                        Detalles
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                        data-id="{{ $student->id }}"
                                        data-name="{{ $student->name }}">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>





<x-modal id="createModal" title="Nuevo Estudiante">
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="create_codigo">Codigo: </label>
            <input type="text" name="codigo" id="create_codigo" class="form-control">
        </div>
        <div class="form-group">
            <label for="create_name">Nombres: </label>
            <input type="text" name="name" id="create_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="create_surname">Apellidos:</label>
            <input type="text" name="surname" id="create_surname" class="form-control">
        </div>
        <div class="form-group">
            <label for="create_age">Edad: </label>
            <input type="text" name="age" id="create_age" class="form-control">
        </div>
        <div class="form-group">
            <label for="create_email">Correo Electrónico: </label>
            <input type="text" name="email" id="create_email" class="form-control">    
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</x-modal>

<x-modal id="editModal" title="Editar Estudiante">
    <form id="editForm" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="edit_codigo">Codigo: </label>
            <input type="text" name="codigo" id="edit_codigo" class="form-control">
        </div>
        <div class="form-group">
            <label for="edit_name">Nombres: </label>
            <input type="text" name="name" id="edit_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="edit_surname">Apellidos:</label>
            <input type="text" name="surname" id="edit_surname" class="form-control">
        </div>
        <div class="form-group">
            <label for="edit_age">Edad: </label>
            <input type="text" name="age" id="edit_age" class="form-control">
        </div>
        <div class="form-group">
            <label for="edit_email">Correo Electrónico: </label>
            <input type="text" name="email" id="edit_email" class="form-control">    
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</x-modal>


<x-modal id="deleteModal" title="Confirmación">
    <p>¿Seguro de desear eliminar al estudiante <strong id="deleteStudentName"></strong>?</p>
    <form id="deleteForm" action="" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </form>
</x-modal>


@section('scripts')

    <script>
    // Modal de Detalles/Edición
    $('button[data-target="#editModal"]').on('click', function() {
        $('#edit_codigo').val($(this).data('codigo'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_surname').val($(this).data('surname'));
        $('#edit_age').val($(this).data('age'));
        $('#edit_email').val($(this).data('email'));
        
        var studentId = $(this).data('id');
        $('#editForm').attr('action', '/students/' + studentId);
    });

    // Modal de Eliminar
    $('button[data-target="#deleteModal"]').on('click', function() {
        var studentId = $(this).data('id');
        var studentName = $(this).data('name');
        
        $('#deleteStudentName').text(studentName);
        $('#deleteForm').attr('action', '/students/' + studentId);
    });
</script>

@endsection


@endsection