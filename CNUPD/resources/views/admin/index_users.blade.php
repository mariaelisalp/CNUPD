@extends('layouts.appPeople')
@section('title', 'Usuários')
@section('content')


@section('content')
    <div class="container-sm mt-5" style="max-width: 1000px;">
        <br><h3 class="text-bg-primary p-3">
            Lista de usuários
        </h3><br>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data de Cadastro</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @if($user->approved == 1)
                                    <p>Habilitado</p>
                                    @else
                                    <p>Desabilitado</p>
                                    @endif
                                </td>
                                <td>
                                    @if($user->approved == 1)
                                        <form action="{{ route('admin.disableUser', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Desabilitar</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.enableUser', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Habilitar</button>
                                        </form>
                                    @endif
                        
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $users->onEachSide(0)->links() }}
                </div><br>
            </div>
            
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @if(session('message1') || session('message2'))
        <script>
            $(document).ready(function() {
                if ("{{ session('message1') }}") {
                    $('#toastWarning').toast('show');
                }
                if ("{{ session('message2') }}") {
                    $('#toastMessage').toast('show');
                }
            });
        </script>
    @endif

    <div class="toast" id = "toastWarning" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Aviso</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('message1') }}
        </div>
    </div><br>

    <div class="toast" id = "toastMessage" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Aviso</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('message2') }}
        </div>
    </div><br><br><br><br><br>
    
@include('parciais.footer')
@endsection