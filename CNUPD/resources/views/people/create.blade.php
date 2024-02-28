@extends('layouts.appPeople')

@section('title', 'Cadastro')

@section('content')
    <br><br><div class="container"></div>
        <div class="container">
            <h4 class="text-bg-primary p-3"> Registrar Pessoa </h4>
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
            <form action="{{route('people.store')}}" class="row g-3" method= 'POST' enctype="multipart/form-data">
            @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <label for="missing" class="form-label">Status</label><br>
                        <select id = "missing" class="form-select"name = "missing" onchange="data()">
                        <option value = "1" {{ old('missing') == '1' ? 'selected' : '' }}>Desaparecido</option>
                        <option value = "0" {{ old('missing') == '0' ? 'selected' : '' }}>Não Identificado</option>
                        </select><br><br>
                        
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label"><p style="color: red; display: inline;">*</p> Nome</label><br>
                        <input type="text" class="form-control" name="name"  value="{{old('name')}}"><br><br>
                        
                    </div>

                    <div class="col-md-4"> 
                        <label for="eye_color" class="form-label">Cor dos Olhos</label>
                        <input type="text"  class="form-control" name="eye_color"  value="{{old('eye_color')}}"><br><br>
                        
                    </div>

                    <div class="col-md-4">
                        <label for="skin_color" class="form-label">Cor da Pele</label><br>
                        <select id = "skin_color" class="form-select" name = "skin_color">
                            <option {{ old('skin_color') == '-' ? 'selected' : '' }}>-</option>
                            <option value = "Preto" {{ old('skin_color') == 'Preto' ? 'selected' : '' }}>Preto</option>
                            <option value = "Branco" {{ old('skin_color') == 'Branco' ? 'selected' : '' }}>Branco</option>
                            <option value = "Pardo" {{ old('skin_color') == 'Pardo' ? 'selected' : '' }}>Pardo</option>
                            <option value = "Indígena" {{ old('skin_color') == 'Indígena' ? 'selected' : '' }}>Indígena</option>
                            <option value = "Amarelo" {{ old('skin_color') == 'Amarelo' ? 'selected' : '' }}>Amarelo</option>
                            
                        </select><br><br>
                    </div>

                    <div class="col-md-4">
                        <label for="gender" class="form-label">Sexo</label><br>
                        <select id = "gender" class="form-select" name = "gender">
                            <option value = "-" {{ old('gender') == '-' ? 'selected' : '' }}>-</option>
                            <option value = "F" {{ old('gender') == 'F' ? 'selected' : '' }}>F</option>
                            <option value = "M" {{ old('gender') == 'M' ? 'selected' : '' }}>M</option>
                            
                        </select><br><br>
                    </div>

                    <div class="col-md-2">
                        <label for="weight" class="form-label">Peso(kg)</label><br>
                        <input type="text" class="form-control" name="weight"  value="{{old('weight')}}"><br><br>
                    </div>

                
                    <div class="col-md-2">
                        <label for="birth_date" class="form-label">Data de Nascimento</label><br>
                        <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}"><br><br>
                    </div>

                    <div class="col-md-4">
                        <label id= "missing_time_date_label" for="missing_time_date" class="form-label"><p style="color: red; display: inline;">*</p>Data de Desaparecimento</label>
                        <input type="date" class="form-control" id = "missing_time_date" name="missing_time_date" value="{{ old('missing_time_date') }}"><br><br>
                    </div>

                    <div class="col-md-2">
                        <label id= "time_date_label" for="time_date" class="form-label">Data </label>
                        <input type="date" class="form-control" id="time_date" name="time_date" value="{{ old('time_date') }}"><br><br>
                    </div>
                        

                    <div class="col-md-2">
                        <label for="age" class="form-label">Idade</label><br>
                        <input type="text" class="form-control" name="age"  value="{{old('age')}}"><br><br>
                    </div>

                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Nome do pai</label><br>
                        <input type="text" class="form-control" name="father_name"  value="{{old('father_name')}}"><br><br>
                    </div>

                    <div class="col-md-6">
                        <label for="mother_name" class="form-label">Nome da mãe</label><br>
                        <input type="text" class="form-control" name="mother_name"  value="{{old('mother_name')}}"><br><br>
                    </div>
                
                
                
                    <div class="col-md-4">
                        <label for="height" class="form-label">Altura</label><br>
                        <input type="text" class="form-control" name="height"  value="{{old('height')}}"><br><br>
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label"> <p style="color: red; display: inline;">*</p>Estado:</label>
                        <select name="state" class="form-select" id="state">
                            <option value="">---</option>
                            @foreach($states as $id => $abbr)
                                <option value="{{ $id }}" {{ old('state') == $id ? 'selected' : ''}}>{{$abbr}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="city" class="form-label"><p style="color: red; display: inline;">*</p>Cidade:</label>
                        <select name="city" class="form-select" id="city" disabled>
                            <option value="" selected>Selecione um estado </option>
                        </select><br><br>
                    </div>

                    <div class="col-md-6">
                        <label for="circumstances" class="form-label"><p style="color: red; display: inline;">*</p>Circunstâncias</label><br>
                        <textarea name="circumstances" class="form-control" id="" cols="20" rows="5">{{old('circumstances')}}</textarea><br><br>
                    </div> 

                    <div class="col-md-6">
                        <label for="other_features" class="form-label">Características Adicionais</label>
                        <textarea name="other_features" class="form-control" id="" cols="15" rows="5">{{old('other_features')}}</textarea><br><br>
                    </div> 

                    <div class="col">
                        <label for="motivations" class="form-label">Possíveis Motivações</label><br>
                        <textarea name="motivations" class="form-control" id="" cols="15" rows="5">{{old('motivations')}}</textarea><br><br>
                    </div>

                    <div class="col">
                        <div class="custom-file">
                            <label for="image" class="custom-file-label">Escolha um arquivo de foto:</label><br>
                            <input type="file" id="image" class="custom-file-input" name="image" accept=".png, .jpg, .jpeg, .gif">
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Registrar</button><br><br>
                        
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
                                console.log(data);
                                $('#city').empty();
                                $('#city').append('<option value="" selected>Selecione uma cidade</option>');
                                $.each(data, function(id, city){
                                    $('#city').append('<option value="'+ id +'">'+ city +'</option>');
                                });
                                $('#city').prop('disabled', false);
                            }
                        });
                    }else{
                        $('#city').empty();
                        $('#city').prop('disabled', true);
                    }
                });
            });
        </script>

        <script>
                function data() {
                    var missing = document.getElementById("missing").value;

                    missing_time_date_label.style.display = "none";
                    missing_time_date.style.display = "none";
                    time_date_label.style.display = "none";
                    time_date.style.display = "none";

                    if (missing === '1') {
                        document.getElementById("missing_time_date_label").style.display = "block";
                        document.getElementById("missing_time_date").style.display = "block";
                    } else {
                        document.getElementById("time_date_label").style.display = "block";
                        document.getElementById("time_date").style.display = "block";
                    }
                }

                document.addEventListener('DOMContentLoaded', function() {
                    data();
                });
        </script>

    </div>
       
@endsection