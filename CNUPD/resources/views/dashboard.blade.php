@php
        $hora = Carbon\Carbon::now()->format('H');
            if ($hora < 12) {
                $saudacao = 'Bom dia';
            } elseif ($hora < 18) {
                $saudacao = 'Boa tarde';
            } else {
                $saudacao = 'Boa noite';
            }
@endphp
@section('title', 'Painel')
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-relaxed "style="color: #000;" >
           {{$saudacao}}, {{auth()->user()->full_name}}!
        </h1>
    </x-slot>

    <div class="py-11">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <a href="{{ '/pessoas/cadastrar' }}">Novo registro de desaparecimento</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <a href="{{ '/pessoas/desaparecidos' }}">Pessoas Desaparecidas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <a href="{{ '/pessoas/nao_identificados' }}">Pessoas Não identificadas</a>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->admin)
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <a href="{{ route('admin.index_requisicoes') }}">Administração do Sistema</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->admin)
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.index_users') }}">Lista de Usuários</a>
                </div>
            </div>
        </div>
    </div>
    @endif

</x-app-layout>