@extends('layouts.appPeople')

@section('title', 'FAQ')

@section('content')

    <br><br><div class="container"></div>
            <div class="container">    
                <h3 class="text-bg-warning p-3">Dúvidas Frequentes</h3><br>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Quem pode cadastrar informações no site?
                            </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                            <strong>Somente autoridades.</strong> Familiares e amigos podem fornecer as informações necessárias às autoridades, mas somente elas tem permissão para fazer registros.
                            </div>
                            </div>
                        </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Posso acessar o site de forma anônima?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Sim, é possível acessar o site de forma anônima para procurar informações sobre pessoas desaparecidas e não identificadas. No entanto, para cadastrar ou atualizar informações, será necessário ter autorização e criar uma conta para garantir a integridade dos dados e a segurança do sistema.
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            O que fazer se encontrar uma pessoa desaparecida?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                        Os usuários devem entrar em contato imediatamente com as autoridades policiais e informar sobre a situação.
                    </div>
        </div>
    </div>         
@endsection