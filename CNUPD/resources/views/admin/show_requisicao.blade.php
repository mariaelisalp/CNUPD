@extends('layouts.appPeople')

@section('title', 'Detalhes')

@section('content')
<div class="container" style="max-width: 900px;">
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    <h4 class="text-bg-primary p-3 mt-4">Dados da solicitação</h4>

    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        ID: {{$user_request->id}} <br>
                        Nome: {{$user_request->full_name}}
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Dados</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Email: {{$user_request->email}} <br>
                        Cidade: {{ $cidade->name }} <br>
                        Estado: {{ $estado->abbr }} <br>
                        Cargo: {{$user_request->position}} <br>
                        Data da Solicitação: {{\Carbon\Carbon::parse($user_request->created_at)->format('d/m/Y')}} <br>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Documentos</h5>
                </div>
                <div class="card-body">
                    @foreach($files as $file)
                    <a href="{{ asset('storage/user_docs/' . $file->file) }}" target="_blank">
                         <button class="btn btn-outline-primary">{{ $file->file }}</button>
                    </a><br><br>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <form action="{{ route('admin.aprova_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success me-2">Aprovar cadastro</button>
            </form>
            <form action="{{ route('admin.rejeita_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Rejeitar solicitação</button>
            </form>
        </div><br><br>
    </div>

</div>
@include('parciais.footer')
@endsection