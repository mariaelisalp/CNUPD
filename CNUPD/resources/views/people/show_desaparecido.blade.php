@extends('layouts.app')

@section('title', 'Detalhes')

@section('content')
    <h2>Pessoa Desaparecida</h2>

    Nome: {{$people->name}} <br><br>
    Cor dos olhos: {{$people->eye_color}} <br><br>
    Cor da pele: {{$people->skin_color}} <br><br>
    Sexo: {{$people->gender}} <br><br>
    Peso: {{$people->weight}} <br><br>
    Cidade: {{ $cityInfo->name }} <br><br>
    Estado: {{ $state->name }} <br><br>
    Data de Nascimento: {{\Carbon\Carbon::parse($people->birth_date)->format('d/m/Y')}} <br><br>
    Data de Desaparecimento: {{\Carbon\Carbon::parse($people->missing_time_date)->tz('America/Sao_Paulo')->format('d/m/Y H:m:s')}} <br><br>
    Idade: {{$people->age}} <br><br>
    Nome do pai: {{$people->father_name}} <br><br>
    Nome da mãe: {{$people->mother_name}} <br><br>
    Altura: {{$people->height}} <br><br>
    Características Adicionais: {{$people->other_features}} <br><br>
    Circunstâncias: {{$people->circumstances}} <br><br>
    Possíveis Motivações: {{$people->motivations}} <br><br>

    Contato: <br>{{ $contactInfo->name_organization }} <br>
    Email: {{ $contactInfo->email }} <br>
    Telefone: {{ $contactInfo->number}} <br><br>
   


    Última Alteração: {{\Carbon\Carbon::parse($people->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:m:s')}} <br><br>

@endsection