@extends('layouts.appPeople')
@section('title', 'Usuários')
@section('content')


@section('content')
    @if (session('message'))
        <script>
            alert("{{ session('message') }}");
        </script>
    @endif
    <h1>Lista de Usuários</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data de Cadastro</th>
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

@endsection