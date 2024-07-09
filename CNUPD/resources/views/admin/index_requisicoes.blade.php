@extends('layouts.appPeople')
@section('title', 'CNUPD')
@section('content')


@section('content')
    <h1>Análise de Solicitações</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID da Solicitação</th>
                <th>Nome</th>
                <th>Data da Solicitação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user_requests as $user_request)
                <tr>
                    <td>{{ $user_request->id }}</td>
                    <td>{{ $user_request->full_name }}</td>
                    <td>{{ $user_request->created_at }}</td>
                    <td>
                        <a href="{{route('admin.exibe_requisicao', $user_request->id)}}">Visualizar</a>
                        <form action="{{ route('admin.aprova_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Aprova</button>
                        </form>
                        <form action="{{ route('admin.rejeita_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Rejeita</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection