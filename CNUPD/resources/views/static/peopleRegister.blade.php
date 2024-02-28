@extends('layouts.appPeople')

@section('title', 'Serviços')

@section('content')
    <br><br><div class="container"></div>
            <div class="container">
                <img src="" alt="">
                <h5 class="text-bg-primary p-3"> Registro de pessoas desaparecidas e não identificadas </h5>
                <p style="text-align: justify;">
                A manutenção de um banco de cadastros de pessoas desaparecidas e não identificadas é de 
                extrema importância. Esse registro centralizado agiliza investigações, permitindo a rápida 
                comparação de dados para identificação de indivíduos desconhecidos. Além disso, proporciona 
                apoio emocional às famílias, oferecendo esperança e informações sobre o progresso das 
                investigações. A existência desse banco também contribui para a prevenção de crimes, 
                identificação de padrões e cooperação interestadual, uma vez que muitos casos transcendem 
                fronteiras. Manter informações organizadas e acessíveis é crucial para garantir eficácia 
                nas ações voltadas para localizar pessoas desaparecidas e identificar aquelas encontradas 
                sem identificação.
                </p><br><br>

                <div class="container" style= "margin-left: auto; margin-right: auto;">
                    <a href="{{'/pessoas/cadastrar'}}">
                        <button class="btn btn-warning btn-lg">Registrar Pessoa</button>
                    </a>
                    
                </div>
            </div><br><br><br><br><br><br>
@endsection