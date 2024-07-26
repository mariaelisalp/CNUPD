@extends('layouts.appPeople')

@section('title', 'Desaparecidos')

@section('content')


    <div class="container">

        <br><br>@if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif <br>
        <h3 class="p-3 mb-2 bg-body-secondary">
            Pessoas Desaparecidas
        </h3><br>
        
        <div class="shadow-none p-3 mb-5 bg-body-tertiary rounded">
        <h5>Filtrar Pesquisa</h5>
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
                </div>
            </form>
        </div>
    </div>
    <hr style="margin-left: auto; margin-right: auto; height: 1px; color: #000; background-color: #000; width: 80%;">

    @if($people->isEmpty())
        <div class="container">
            <p>Nenhum resultado encontrado para a pesquisa "{{ $search }}".</p>
        </div>
        
    @else
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered">
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
            </div>
            
            

        </div>
        
        
    @endif

    <div class="container">
    @if(auth()->user())
        <a href="{{'/pessoas/cadastrar'}}">
            <button class="btn btn-warning btn-lg">Cadastrar Pessoa</button>
        </a><br><br>
    @endif
    </div>
@include('parciais.footer')
@endsection