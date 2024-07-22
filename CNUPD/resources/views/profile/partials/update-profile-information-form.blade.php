<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="full_name" :value="__('Name')" />
            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->full_name)" required autofocus autocomplete="full_name" />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <div>
            <x-select-option id="position" name="position" label="Cargo" class="block mt-1 w-full">
                <option value="Delegado" {{ old('position', $user->position) == 'Delegado' ? 'selected' : '' }}>Delegado</option>
                <option value="Sargento" {{ old('position', $user->position) == 'Sargento' ? 'selected' : '' }}>Sargento</option>
                <option value="Oficial de Polícia" {{ old('position', $user->position) == 'Oficial de Polícia' ? 'selected' : '' }}>Oficial de Polícia</option>
                <option value="Inspetor" {{ old('position', $user->position) == 'Inspetor' ? 'selected' : '' }}>Inspetor</option>
                <option value="'Investigador" {{ old('position', $user->position) == 'Investigador' ? 'selected' : '' }}>Investigador</option>
                <option value="Escrivão de Polícia" {{ old('position', $user->position) == 'Escrivão de Polícia' ? 'selected' : '' }}>Escrivão de Polícia</option>
                <option value="Outro Cargo" {{ old('position', $user->position) == 'Outro Cargo' ? 'selected' : '' }}>Outro cargo</option>   
            </x-select-option>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-select-option id="state" name="state" label="Estado" class="block mt-1 w-1/2">
                <option value="">-</option>
                    @foreach($states as $id => $abbr)
                        <option value="{{ $id }}" {{ old('state', $state->id) == $id ? 'selected' : ''}}>{{$abbr}}</option>
                    @endforeach
            </x-select-option>
            <x-input-error class="mt-2" :messages="$errors->get('state')" />
        </div>

        <div>
            <x-select-option id="city" name="city" label="Cidade" class="block mt-1 w-1/2">
            <option value="{{ $user->city_id }}" selected>{{ $city->name }}</option>
            </x-select-option>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>

       
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#state').on('change', function(){
                    var state_id = $(this).val();
                    if(state_id){
                        $.ajax({
                            url: '/pessoas/cadastrar/buscar-cidades/' + state_id,
                            type: 'GET',
                            dataType: 'json',
                            success:function(data){
                                $('#city').empty();
                                $('#city').append('<option value="" selected>Selecione uma cidade</option>');
                                $.each(data, function(id, city){
                                    $('#city').append('<option value="'+ id +'">'+ city +'</option>');
                                });
                                $('#city').prop('disabled', false);

                                // Preencher o campo de cidade com o valor existente do banco de dados
                                var city_id = '{{ old('city' , $user->city_id) }}';
                                var city_name = '{{ $city->name }}';
                                if (city_id && city_name) {
                                    $('#city').val(city_id); 
                                }
                            }
                        });
                    } else {
                        $('#city').empty();
                        $('#city').prop('disabled', true);
                    }
                });
                $('#state').trigger('change');

            });
        </script>

        <script>
            $('form').on('submit', function() {
             console.log('Formulário enviado!');
             });

        </script>
</section>
