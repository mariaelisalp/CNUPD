@extends('layouts.appPeople')

@section('title', 'Detalhes')

@section('content')

    
     <div class="container" style="max-width: 900px;">

          <br><br>@if(session('success'))
               <div class="alert alert-success">
                    {{ session('success') }}
               </div>
          @endif <br>

          <br><h4 class="text-bg-primary p-3">Dados da solicitação </h4>

          
               <div class="row">

                    <div class="col-md-4 mt-3 ms-3">
                         <div class="card" style="width: 14rem;">
                           
                              <div class="card-body">
                                   <h5 class="card-title">
                                    ID: {{$user_request->id}} <br>
                                    Nome: {{$user_request->full_name}}</h5>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-7 mt-3 mr-3">
                         <div class="card" style="width: 30rem;">
                         <div class="card-header"><h5 class="card-title">Dados</h5></div>
                              <div class="card-body">
                                   <p class="card-text">
                                    Email: {{$user_request->email}} <br>
                                   Cidade: {{ $cidade->name }} <br>
                                   Estado: {{ $estado->abbr }} <br>
                                   Data da Solicitação: {{\Carbon\Carbon::parse($user_request->created_at)->format('d/m/Y')}} <br>
                                   </p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 mt-3 ms-3">
                         <div class="card" style="width: 20rem;">
                         <div class="card-header"><h5 class="card-title">Documentos</h5></div>
                              <div class="card-body">
                                   <p class="card-text">
                                   @foreach($files as $file)
                                   <a href="storage/user_docs/{{$file->file}}" target="_blank">
                                        <button class="btn btn-outline-primary">{{ $file->file }}</button>
                                   </a><br><br>
                                   @endforeach
                                   </p>
                              </div>
                         </div>
                    </div>

                    <form action="{{ route('admin.aprova_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Aprova</button>
                        </form>
                        <form action="{{ route('admin.rejeita_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Rejeita</button>
                        </form>
                    
                    
               </div>
          
        
     </div>
    

@endsection
