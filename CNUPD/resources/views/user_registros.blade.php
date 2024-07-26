@extends('layouts.appPeople')

@section('title', 'Meus Registros')

@section('content')
<div class="container-sm mt-5" style="max-width: 1000px;">
        <br><h3 class="bg-primary-subtle text-primary-emphasis p-3">
            Meus Registros
        </h3><br>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($people as $person)
                            <tr>
                                <td>{{ $person->id }}</td>
                                <td><a href="{{route('people.show', ['people' => $person->id])}}">{{ $person->name }}</a></td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $people->onEachSide(0)->links() }}
                </div><br>
            </div>
            
        </div>
        
    </div>

<footer style="position:fixed; bottom: 0; width: 100%;">
@include('parciais.footer') 
</footer>
@endsection