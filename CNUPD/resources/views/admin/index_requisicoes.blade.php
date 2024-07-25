@extends('layouts.appPeople')
@section('title', 'CNUPD')
@section('content')


@section('content')

    <div class="container-sm mt-5" style="max-width: 1000px;">
        <br><h3 class="text-bg-primary p-3">
            Solicitações de acesso
        </h3><br>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered">
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
                                    <a class="btn btn-dark" href="{{route('admin.exibe_requisicao', $user_request->id)}}">Visualizar</a>
                                    <!--<form action="{{ route('admin.aprova_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Aprovar</button>
                                    </form>
                                    <form action="{{ route('admin.rejeita_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Rejeitar</button>
                                    </form>-->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $user_requests->onEachSide(0)->links() }}
                </div><br>
            </div>
            
        </div>

        @if(session('message'))
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{session('message')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Caso haja necessidade, você pode gerenciar o acesso de usuário na aba de listagem de usuários.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    
    </div> 

<footer style="position:fixed; bottom: 0; width: 100%;">
@include('parciais.footer')
</footer> 
@endsection