@extends('layouts.app')

@section('title', 'Cadastro')

@section('content')
    <div class="container"></div>
        <h1> Registrar Pessoa Desaparecida </h1>
        <hr>

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
         

        <h4 style="color: red;">Campos marcados com * são obrigatórios.</h4>

        <form action="{{route('people.store')}}" method= 'POST'>
        @csrf

            <div class="form-group">
                <div class="form-group">

                    <label for="missing">Status</label><br>
                    <select id = "missing" name = "missing" onchange="data()">
                    <option value = "1" {{ old('missing') == '1' ? 'selected' : '' }}>Desaparecido</option>
                    <option value = "0" {{ old('missing') == '0' ? 'selected' : '' }}>Não Identificado</option>
                    </select><br><br>

                    <label for="name"><p style="color: red; display: inline;">*</p> Nome</label><br>
                    <input type="text" name="name"  value="{{old('name')}}"><br><br>

                    <label for="eye_color">Cor dos Olhos</label><br>
                    <input type="text" name="eye_color"  value="{{old('eye_color')}}"><br><br>

                    <label for="skin_color">Cor da Pele</label><br>
                    <input type="text" name="skin_color"  value="{{old('skin_color')}}"><br><br>

                    <label for="gender">Sexo</label><br>
                    <select id = "gender" name = "gender">
                        <option value = "-" {{ old('gender') == '-' ? 'selected' : '' }}>-</option>
                        <option value = "F" {{ old('gender') == 'F' ? 'selected' : '' }}>F</option>
                        <option value = "M" {{ old('gender') == 'M' ? 'selected' : '' }}>M</option>
                        
                    </select><br><br>

                    <label for="weight">Peso(kg)</label><br>
                    <input type="text" name="weight"  value="{{old('weight')}}"><br><br>

                    <label for="birth_date">Data de Nascimento</label><br>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}"><br><br>

                    <label id= "missing_time_date_label" for="missing_time_date"><p style="color: red; display: inline;">*</p>Data de Desaparecimento</label><br>
                    <input type="date" id = "missing_time_date" name="missing_time_date" value="{{ old('missing_time_date') }}"><br><br>

                    <label id= "time_date_label" for="time_date">Data </label><br>
                    <input type="date" id="time_date" name="time_date" value="{{ old('time_date') }}"><br><br>

                    <label for="age">Idade</label><br>
                    <input type="text" name="age"  value="{{old('age')}}"><br><br>

                    <label for="father_name">Nome do pai</label><br>
                    <input type="text" name="father_name"  value="{{old('father_name')}}"><br><br>

                    <label for="mother_name">Nome da mãe</label><br>
                    <input type="text" name="mother_name"  value="{{old('mother_name')}}"><br><br>

                    <label for="height">Altura</label><br>
                    <input type="text" name="height"  value="{{old('height')}}"><br><br>

                    <label for="other_features">Características Adicionais</label><br><br>
                    <textarea name="other_features" id="" cols="30" rows="10">{{old('other_features')}}</textarea><br><br>

                    <label for="circumstances"><p style="color: red; display: inline;">*</p>Circunstâncias</label><br>
                    <textarea name="circumstances" id="" cols="30" rows="10">{{old('circumstances')}}</textarea><br><br>

                    <label for="motivations">Possíveis Motivações</label><br>
                    <textarea name="motivations" id="" cols="30" rows="10">{{old('motivations')}}</textarea><br><br>

                    <label for="email"><p style="color: red; display: inline;">*</p>Email(somente autoridades)</label><br>
                    <input type="text" name="email"  value="{{old('email')}}"><br><br>

                    <label for="name_organization"><p style="color: red; display: inline;">*</p>Nome do Local/Organização de Registro</label><br>
                    <input type="text" name="name_organization"  value="{{old('name_organization')}}"><br><br>

                    <label for="number"><p style="color: red; display: inline;">*</p>Telefone(somente autoridades)</label><br>
                    <input type="text" name="number"  value="{{old('number')}}" placeholder = "apenas números(11 dígitos)"><br><br>

                    <label for="state"><p style="color: red; display: inline;">*</p>Estado:</label>
                    <select name="state" id="state">
                        @foreach($states as $id => $abbr)
                            <option value="{{ $id }}" {{ old('state') == $id ? 'selected' : ''}}>{{$abbr}}</option>
                        @endforeach
                    </select>

                    <label for="city"><p style="color: red; display: inline;">*</p>Cidade:</label>
                    <select name="city" id="city" disabled>
                        <option value="" selected>Selecione um estado </option>
                    </select><br><br>

                    <button type = "submit" >Registrar</button>   
                </div>  
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