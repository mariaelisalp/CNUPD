@extends('layouts.appPeople')
@section('title', 'Registrar')
@section('content')
<x-guest-layout>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @if(session('message'))
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show');
                
            });

        </script>
    @endif
  
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Solicitação enviada com sucesso.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                {{ session('message') }} <br>
                <div class="float-end">Atenciosamente, CNUPD.</div><br>

            </div>
                <div class="modal-footer">
                    <x-close-button type="button" data-bs-dismiss="modal">Fechar</x-close-button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Você tem certeza que deseja solicitar acesso?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Ao enviar o formulário não será possível alterar as informações.
                </div>
                <div class="modal-footer">
                    <x-danger-button type="button" data-bs-dismiss="modal">Cancelar</x-danger-button>
                    <x-primary-button type="button" id="confirmSubmit">Confirmar</x-primary-button>
                </div>
            </div>
        </div>
    </div>



    <form id="registrationForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="full_name" :value="__('Full Name')" />
            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Position -->
   

        <div class="mt-4">
            <x-select-option id="position" name="position" label="Cargo" class="block mt-1 w-full">
                <option value="Delegado" {{ old('position') == 'Delegado' ? 'selected' : '' }}>Delegado</option>
                <option value="Sargento" {{ old('position') == 'Sargento' ? 'selected' : '' }}>Sargento</option>
                <option value="Oficial de Polícia" {{ old('position') == 'Oficial de Polícia' ? 'selected' : '' }}>Oficial de Polícia</option>
                <option value="Inspetor" {{ old('position') == 'Inspetor' ? 'selected' : '' }}>Inspetor</option>
                <option value="Cientista Forense" {{ old('position') == 'Cientista Forense' ? 'selected' : '' }}>Cientista Forense</option>
                <option value="Perito Criminal" {{ old('position') == 'Perito Criminal' ? 'selected' : '' }}>Perito Criminal</option>
                <option value="Investigador" {{ old('position') == 'Investigador' ? 'selected' : '' }}>Investigador</option>
                <option value="Escrivão de Polícia" {{ old('position') == 'Escrivão de Polícia' ? 'selected' : '' }}>Escrivão de Polícia</option>
                <option value="Outro Cargo" {{ old('position') == 'Outro Cargo' ? 'selected' : '' }}>Outro cargo</option>   
            </x-select-option>
        </div>

        <!-- States and Cities -->
        <div class="mt-4">
            <x-select-option id="state" name="state" label="Estado" class="block mt-1 w-full">
                <option value="">-</option>
                    @foreach($states as $id => $abbr)
                        <option value="{{ $id }}" {{ old('state') == $id ? 'selected' : ''}}>{{$abbr}}</option>
                    @endforeach
            </x-select-option>
        </div>

        <div class="mt-4">
            
            <x-select-option id="city" name="city" label="Cidade" class="block mt-1 w-full">
                <option value="" selected>Selecione um estado</option>
            </x-select-option>
            
        </div>
        
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Upload -->
        <div class="mt-4">
            <x-input-label for="files" :value="__('Upload de Documentos')" />
            <div class="flex flex-col items-center justify-center w-full">
                    <label class="flex flex-col items-center w-full px-4 py-6 bg-white rounded-lg shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-gray-200 hover:text-gray-700 text-gray-600 ease-linear transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                        <span class="mt-2 text-sm leading-normal">Selecione os arquivos</span>
                        <input type="file" id="files" name="files[]" class="hidden" onchange="newInput(this)" multiple>
                    </label>
                    <ul id="dp-files" class="list-disc pl-5 mt-2 w-full"></ul>
            </div>
            
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button type="button" class="ms-4" id="requestAccessButton">
                {{ __('Solicitar acesso ao sistema') }}
            </x-primary-button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            // função para tratar exibição de cidades e estados.
            $(document).ready(function() {
                function loadCities(state_id, selected_city_id) {
                    if (state_id) {
                        $.ajax({
                            url: '/pessoas/cadastrar/buscar-cidades/' + state_id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#city').empty();
                                $('#city').append('<option value="" selected>Selecione uma cidade</option>');
                                $.each(data, function(id, city) {
                                    $('#city').append('<option value="' + id + '">' + city + '</option>');
                                });
                                if (selected_city_id) {
                                    $('#city').val(selected_city_id);
                                }
                                $('#city').prop('disabled', false);
                            }
                        });
                    } else {
                        $('#city').empty();
                        $('#city').prop('disabled', true);
                    }
                }

                $('#state').on('change', function() {
                    var state_id = $(this).val();
                    loadCities(state_id);
                });

                var initial_state_id = $('#state').val();
                var initial_city_id = $('#city').data('selected-city-id'); // Pegue o valor selecionado da cidade

                if (initial_state_id) {
                    loadCities(initial_state_id, initial_city_id);
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('files');
                const fileList = document.getElementById('dp-files');
                let selectedFiles = [];

                input.addEventListener('change', function () {
                    const newFiles = Array.from(input.files);
                    newFiles.forEach(file => {
                        if (!selectedFiles.includes(file)) {
                            selectedFiles.push(file);
                            const listItem = document.createElement('li');
                            listItem.textContent = file.name + ' ';
                            const removeButton = document.createElement('button');
                            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
                            removeButton.type = 'x-danger-button';
                            removeButton.textContent = 'Remover';
                            removeButton.addEventListener('click', function () {
                                const index = selectedFiles.indexOf(file);
                                if (index !== -1) {
                                    selectedFiles.splice(index, 1);
                                    fileList.removeChild(listItem);
                                    updateInputFiles();
                                }
                            });
                            listItem.appendChild(removeButton);
                            fileList.appendChild(listItem);
                        }
                    });
                    updateInputFiles();
                });

                function updateInputFiles() {
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(file => dataTransfer.items.add(file));
                    input.files = dataTransfer.files;
                }
            });

         </script>

         <script>
            $('#requestAccessButton').on('click', function() {
                $('#confirmationModal').modal('show');
            });

            $('#confirmSubmit').on('click', function() {
                $('#registrationForm').submit();
            });
         </script>

</x-guest-layout><br>
@include('parciais.footer')
@endsection

