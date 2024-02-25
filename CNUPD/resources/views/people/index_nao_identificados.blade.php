@extends('layouts.app')

@section('title', 'Não Identificados')

@section('content')
    <h1>Pessoas Não Identificadas</h1>

    <div>
        <span>Pesquisar</span><br>
        <div>
            <form action="{{route('people.index_nao_identificados')}}" method="GET">
                <div class="row">
                    <label for="search" ></label>
                    <input type="text" name= "search" class="larger-input" id= "search" style="width: 300px;" placeholder= "Pesquisar por Cidade, Estado, Gênero, etc" value= "{{$search}}">
                </div><br>

                <div class="row">
                    <label for="date" >Data</label>
                    <input type="date" name= "date" id= "date" value= "{{$date}}">
                </div><br>

                <div>
                    <button type= "submit">Pesquisar</button>
                    <a href="{{route('people.index_nao_identificados')}}">Limpar</a>
                </div>
            </form>
        </div>
    </div><br>
    <hr>

    @if($people->isEmpty())
        <p>Nenhum resultado encontrado para a pesquisa "{{ $search }}".</p>
    @else
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Data</th>
            <th scope="col">Nome</th>
            <th scope="col">Idade</th>
            <th scope="col">Sexo</th>
            <th scope="col">Cidade</th>
            <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>

        @foreach($people as $person)
            <tr>
                <td>{{$person->id}}</td>
                <td>{{\Carbon\Carbon::parse($person->time_date)->format('d/m/Y')}}</td>
                <td>{{$person->name}}</td>
                <td>{{$person->age}}</td>
                <td>{{$person->gender}}</td>
                <td>{{$person->city}}</td>
                <td>{{$person->state}}</td>
                <td><a href="{{route('people.show', ['people' => $person->id])}}">Visualizar</a></td>
            </tr>
        
        @endforeach
    
            </tr>
        </tbody>
        </table><br>

        <a href="{{'/pessoas/cadastrar'}}">Cadastrar pessoa</a><br><br>

        <div class="pagination">
            {{ $people->onEachSide(0)->links() }}
        </div><br>
    @endif

@endsection