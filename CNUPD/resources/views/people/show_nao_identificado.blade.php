@extends('layouts.appPeople')

@section('title', 'Detalhes')

@section('content')

    
     <div class="container" style="max-width: 900px;">

          <br><br>@if(session('success'))
               <div class="alert alert-success">
                    {{ session('success') }}
               </div>
          @endif <br>

          <br><h4 class="text-bg-primary p-3">Pessoa Não Identificada </h4><br>

          
          <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
               <div class="row">

                    <div class="col-md-7 mt-3 mr-3">
                         <div class="card" style="width: 30rem;">
                         <div class="card-header"><h5 class="card-title">Dados</h5></div>
                              <div class="card-body">
                                   <p class="card-text">
                                   Cidade: {{ $city->name }} <br>
                                   Estado: {{ $state->name }} <br>
                                   Data de Nascimento: {{\Carbon\Carbon::parse($people->birth_date)->format('d/m/Y')}} <br>
                                   Data: {{\Carbon\Carbon::parse($people->time_date)->tz('America/Sao_Paulo')->format('d/m/Y H:m:s')}} <br>
                                   Idade: {{$people->age}} anos <br>
                                   Nome do pai: {{$people->father_name}} <br>
                                   Nome da mãe: {{$people->mother_name}} <br>
                                   </p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 mt-3 ms-3">
                         <div class="card" style="width: 14rem;">
                              <img src="/storage/images/{{$people->image}}" alt="" class="img-fluid">
                              <div class="card-body">
                                   <h5 class="card-title">Nome: {{$people->name}}</h5>
                              </div>
                         </div>
                    </div>

               </div>



               <div class="col-md-6 mt-3">
                    <div class="card" style="width: 30rem;">
                         <div class="card-header"><h5 class="card-title">Características</h5></div>
                              <div class="card-body">
                                   <p class="card-text">
                                   Cor dos olhos: {{$people->eye_color}} <br>
                                   Cor da pele: {{$people->skin_color}} <br>
                                   Sexo: {{$people->gender}} <br>
                                   Peso: {{$people->weight}} KG<br>
                                   Altura: {{$people->height}} <br>
                                   Características Adicionais: {{$people->other_features}} <br>
                                   </p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 mt-3">
                         <div class="card" style="width: 30rem;">
                              <div class="card-header"><h5 class="card-title">Circunstâncias</h5></div>
                              <div class="card-body">
                                   <p class="card-text">
                                   {{$people->circumstances}} <br>
                                   </p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 mt-3">
                         <div class="card" style="width: 30rem;">
                              <div class="card-header"><h5 class="card-title">Possíveis Motivações</h5></div>
                              <div class="card-body">
                                   <p class="card-text">
                                   {{$people->motivations}} <br>
                                   </p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 mt-3">
                         <div class="card" style="width: 30rem;">
                              <div class="card-header"><h5 class="card-title">Contato</h5></div>
                              <div class="card-body">
                                   <p class="card-text">
                                   {{ $contactInfo->name_station }} <br>
                                   Email: {{ $contactInfo->email }} <br>
                                   Telefone: {{ $contactInfo->number}} <br>
                                   </p>
                              </div>
                         </div>
                    </div>



                    <br> Última Alteração: {{\Carbon\Carbon::parse($people->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:m:s')}} <br><br>
                    @if(auth()->user()->admin || (auth()->user() && $permission))
                    <div class="d-inline-block">
                    <a href="{{route('people.edit', ['people' => $people->id])}}"><button class="btn btn-warning">Editar</button></a>

               </div>

               <div class="d-inline-block">
                    <form id="deleteForm" action="{{route('people.delete', ['people' => $people->id])}}" method="POST">
                    @csrf
                    @method('delete')

                    <button type="button" id="deleteButton" class="btn btn-danger">Excluir</button>
                    </form>
               </div><br><br><br>
               @endif
          </div>
          
     </div>

     <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Você tem certeza que deseja excluir esse registro?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Não será possível desfazer essa operação.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger" type="button" id="confirmSubmit" >Excluir</button>
                </div>
            </div>
        </div>
    </div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
          $('#deleteButton').on('click', function() {
                $('#confirmationModal').modal('show');
            });

            $('#confirmSubmit').on('click', function() {
                $('#deleteForm').submit();
            });
     </script>
    
@include('parciais.footer')
@endsection
