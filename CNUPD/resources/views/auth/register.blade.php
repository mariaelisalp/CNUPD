@extends('layouts.appPeople')
@section('title', 'Registrar')
@section('content')
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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
            <x-input-label for="position" :value="__('Cargo')" />
            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('position')" class="mt-2" />
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
        <input type="file" id="files" class="file-input" name="files[]" onchange="newInput(this)" multiple="multiple"><br>
            
        </div>
        <ul id="dp-files"></ul>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Solicitar acesso ao sistema') }}
            </x-primary-button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
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

                // Quando o estado é mudado
                $('#state').on('change', function() {
                    var state_id = $(this).val();
                    loadCities(state_id);
                });

                // Verifique se um estado já está selecionado ao carregar a página
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

</x-guest-layout><br><br>
@endsection
