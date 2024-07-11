@extends('layouts.appPeople')

@section('title', 'Editar')

@section('content')
    <br><br><div class="container"></div>
        <div class="container">
            <h4 class="text-bg-primary p-3"> Editar</h4>
        </div>

        <div class="container">

            @if ($errors->any())
                <span style="color: red;">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </span>  
            @endif

            <br><p style="color: red;">Campos marcados com * são obrigatórios.</p><br>
            <form action="{{route('people.update', ['people' => $people->id])}}" class="row g-3" method= 'POST' enctype="multipart/form-data">
            @csrf
            @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <label for="missing" class="form-label">Status</label><br>
                        <select id = "missing" class="form-select"name = "missing" onchange="data()">
                        <option value = "1" {{ old('missing', $people->missing) == '1' ? 'selected' : '' }}>Desaparecido</option>
                        <option value = "0" {{ old('missing', $people->missing) == '0' ? 'selected' : '' }}>Não Identificado</option>
                        </select><br><br>
                        
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label"><p style="color: red; display: inline;">*</p> Nome</label><br>
                        <input type="text" class="form-control" name="name"  value="{{old('name', $people->name)}}"><br><br>
                        
                    </div>

                    <div class="col-md-4"> 
                        <label for="eye_color" class="form-label">Cor dos Olhos</label>
                        <input type="text"  class="form-control" name="eye_color"  value="{{old('eye_color', $people->eye_color)}}"><br><br>
                        
                    </div>

                    <div class="col-md-4">
                        <label for="skin_color" class="form-label">Cor da Pele</label><br>
                        <select id = "skin_color" class="form-select" name = "skin_color">
                            <option {{ old('skin_color') == '-' ? 'selected' : '' }}>-</option>
                            <option value = "Preto" {{ old('skin_color', $people->skin_color) == 'Preto' ? 'selected' : '' }}>Preto</option>
                            <option value = "Branco" {{ old('skin_color', $people->skin_color) == 'Branco' ? 'selected' : '' }}>Branco</option>
                            <option value = "Pardo" {{ old('skin_color', $people->skin_color) == 'Pardo' ? 'selected' : '' }}>Pardo</option>
                            <option value = "Indígena" {{ old('skin_color', $people->skin_color) == 'Indígena' ? 'selected' : '' }}>Indígena</option>
                            <option value = "Amarelo" {{ old('skin_color', $people->skin_color) == 'Amarelo' ? 'selected' : '' }}>Amarelo</option>
                            
                        </select><br><br>
                    </div>

                    <div class="col-md-4">
                        <label for="gender" class="form-label">Sexo</label><br>
                        <select id = "gender" class="form-select" name = "gender">
                            <option value = "-" {{ old('gender', $people->gender) == '-' ? 'selected' : '' }}>-</option>
                            <option value = "F" {{ old('gender', $people->gender) == 'F' ? 'selected' : '' }}>F</option>
                            <option value = "M" {{ old('gender', $people->gender) == 'M' ? 'selected' : '' }}>M</option>
                            
                        </select><br><br>
                    </div>

                    <div class="col-md-2">
                        <label for="weight" class="form-label">Peso(kg)</label><br>
                        <input type="text" class="form-control" name="weight"  value="{{old('weight', $people->weight)}}"><br><br>
                    </div>

                
                    <div class="col-md-2">
                        <label for="birth_date" class="form-label">Data de Nascimento</label><br>
                        <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date', $people->birth_date) }}"><br><br>
                    </div>

                    <div class="col-md-3">
                        <label for="age" class="form-label">Idade</label><br>
                        <input type="text" class="form-control" name="age"  value="{{old('age', $people->age)}}"><br><br>
                    </div>

                    <div class="col-md-3" id="div_missing_time_date" style="display: none;">
                        <label id="missing_time_date" for="missing_time_date" class="form-label"><p style="color: red; display: inline;">*</p>Data de Desaparecimento</label>
                        <input type="date" class="form-control" id="missing_time_date" name="missing_time_date" value="{{ old('missing_time_date', $people->missing_time_date) }}">
                    </div>

                    <div class="col-md-3" id="div_time_date" style="display: none;">
                        <label id="time_date" for="time_date" class="form-label">Data de Registro</label>
                        <input type="date" class="form-control" id="time_date" name="time_date" value="{{ old('time_date', $people->time_date) }}">
                    </div>
                        

                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Nome do pai</label><br>
                        <input type="text" class="form-control" name="father_name"  value="{{old('father_name', $people->father_name)}}"><br><br>
                    </div>

                    <div class="col-md-6">
                        <label for="mother_name" class="form-label">Nome da mãe</label><br>
                        <input type="text" class="form-control" name="mother_name"  value="{{old('mother_name', $people->mother_name)}}"><br><br>
                    </div>
                
                
                
                    <div class="col-md-4">
                        <label for="height" class="form-label">Altura</label><br>
                        <input type="text" class="form-control" name="height"  value="{{old('height', $people->height)}}"><br><br>
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label"><p style="color: red; display: inline;">*</p>Estado:</label>
                        <select name="state" class="form-select" id="state">
                            <option value="">---</option>
                            @foreach($states as $id => $abbr)
                                <option value="{{ $id }}" {{ old('state', $state->id) == $id ? 'selected' : ''}}>{{$abbr}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="city" class="form-label"><p style="color: red; display: inline;">*</p>Cidade:</label>
                        <select name="city" class="form-select" id="city">
                            <option value="{{ $people->city_id }}" selected>{{ $city->name }}</option>
                        </select><br><br>
                    </div>

                    <div class="col-md-6">
                        <label for="circumstances" class="form-label"><p style="color: red; display: inline;">*</p>Circunstâncias</label><br>
                        <textarea name="circumstances" class="form-control" id="" cols="20" rows="5">{{old('circumstances', $people->circumstances)}}</textarea><br><br>
                    </div> 

                    <div class="col-md-6">
                        <label for="other_features" class="form-label">Características Adicionais</label>
                        <textarea name="other_features" class="form-control" id="" cols="15" rows="5">{{old('other_features', $people->other_features)}}</textarea><br><br>
                    </div> 

                    <div class="col">
                        <label for="motivations" class="form-label">Possíveis Motivações</label><br>
                        <textarea name="motivations" class="form-control" id="" cols="15" rows="5">{{old('motivations', $people->motivations)}}</textarea><br><br>
                    </div>

                    <div class="col">
                        <div class="custom-file">
                            <label for="image" class="custom-file-label">Adicionar ou trocar arquivo de foto:</label><br>
                            @if($people->image != 'noImage.jpg')
                            <img id="previewImage" src="/storage/images/{{$people->image}}" alt="Imagem atual" class="card" style="width: 14rem;">
                            @endif
                            <br><input type="file" id="image" class="form-control" name="image" accept=".png, .jpg, .jpeg, .gif"><br>
                            <button type="button" class="btn btn-danger" id="removeImageBtn">Remover Imagem</button>
                            <input type="hidden" name="remove_image" id="remove_image" value="0">
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Editar</button><br><br>
                        
                    </div>
                </div>
                
            </form>
        </div>

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
                                var city_id = '{{ old('city' , $people->city_id) }}';
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
            function data() {
                var missing = document.getElementById("missing").value;

                if (missing === '1') {
                    document.getElementById("div_missing_time_date").style.display = "block";
                    document.getElementById("div_time_date").style.display = "none";
                } else if (missing === '0') {
                    document.getElementById("div_missing_time_date").style.display = "none";
                    document.getElementById("div_time_date").style.display = "block";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                data();

                document.getElementById("missing").addEventListener('change', function() {
                    data(); // Chama a função quando o valor do select mudar
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const removeBtn = document.getElementById('removeImageBtn');
            const previewImage = document.getElementById('previewImage');
            const removeImageInput = document.getElementById('remove_image');

            // Inicializa o botão de remoção
            if (!input.files.length && '{{ $people->image }}' != 'noImage.jpg') {
                removeBtn.style.display = 'none';
            }

            if ('{{ $people->image }}') {
                removeBtn.style.display = 'inline-block';
            }

            // Evento de mudança no input de arquivo
            input.addEventListener('change', function () {
                const file = input.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    removeBtn.style.display = 'inline-block';
                    removeImageInput.value = '0'; // resetar o valor ao selecionar uma nova imagem
                } else {
                    previewImage.src = '{{ asset('storage/' . $people->image) }}';
                    removeBtn.style.display = 'none';
                }
            });

            // Evento de clique no botão de remoção
            removeBtn.addEventListener('click', function () {
                input.value = '';
                previewImage.src = '{{ asset('storage/' . $people->image) }}';
                removeBtn.style.display = 'none';
                removeImageInput.value = '1'; // definir o valor para indicar a remoção da imagem
            });
        });
        </script>


    </div>
       
@endsection