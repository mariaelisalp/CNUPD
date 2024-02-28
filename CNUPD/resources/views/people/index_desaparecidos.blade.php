@extends('layouts.appPeople')

@section('title', 'Desaparecidos')

@section('content')


    <div class="container">

        <br><br>@if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <br><br><h3 class="text-bg-primary p-3">
            Pessoas Desaparecidas
        </h3><br>
        <h5>Filtrar Pesquisa</h5>
        <div>
            <form action="{{route('people.index_desaparecidos')}}" method="GET">
                <div class="col-md-8">
                    <label for="search" class="form-label">Pesquisar</label>
                    <input type="text" name= "search" class="form-control" id= "search" style="width: 50%;" placeholder= "Pesquisar por Nome, Cidade, Estado, etc" value= "{{$search}}">
                </div><br>

                <div class="col-md-2">
                    <label for="date" class="form-label" >Data</label>
                    <input type="date" class="form-control" name="date" id= "date" value= "{{$date}}">
                </div><br>

                <div>
                    <button type= "submit" class="btn btn-primary">Pesquisar</button>
                    <a href="{{route('people.index_desaparecidos')}}">
                        <button class="btn btn-secondary">Limpar</button>
                    </a>
                </div>
            </form>
        </div>
    </div><br>
    <hr style="margin-left: auto; margin-right: auto; height: 1px; color: #000; background-color: #000; width: 80%;">

    @if($people->isEmpty())
        <p>Nenhum resultado encontrado para a pesquisa "{{ $search }}".</p>
    @else
        <div class="container">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Data de Desaparecimento</th>
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
                    <td>{{\Carbon\Carbon::parse($person->missing_time_date)->format('d/m/Y')}}</td>
                    <td>{{$person->name}}</td>
                    <td>{{$person->age}}</td>
                    <td>{{$person->gender}}</td>
                    <td>{{$person->city}}</td>
                    <td>{{$person->state}}</td>
                    <td><a href="{{route('people.show', ['people' => $person->id])}}">
                        <button class="btn btn-dark">Visualizar</button></a></td>

                </tr> 
            
            @endforeach
        
                </tr>
            </tbody>
            </table><br>

            <div class="pagination">
                {{ $people->onEachSide(0)->links() }}
            </div><br>
            
            <div class="container">
                <a href="{{'/pessoas/cadastrar'}}">
                    <button class="btn btn-warning btn-lg">Cadastrar Pessoa</button>
                </a><br><br>
            </div>

        </div>
        
        
    @endif

@endsection