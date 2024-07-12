
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           {{$saudacao}}, {{auth()->user()->full_name}}!
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ '/pessoas/cadastrar' }}">Novo registro de desaparecimento</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ '/pessoas/desaparecidos' }}">Pessoas Desaparecidas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ '/pessoas/nao_identificados' }}">Pessoas Não identificadas</a>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->admin)
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('admin.index_requisicoes') }}">Administração do Sistema</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->admin)
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('admin.index_users') }}">Lista de Usuários</a>
                </div>
            </div>
        </div>
    </div>
    @endif

</x-app-layout>
@include('parciais.footer')
