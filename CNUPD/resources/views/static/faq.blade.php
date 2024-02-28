@extends('layouts.appPeople')

@section('title', 'FAQ')

@section('content')
    <br><br><div class="container"></div>
            <div class="container">
                <img src="" alt="">
                <h3 class="text-bg-primary p-3"> Dúvidas Frequentes </h3>

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                         Quem pode cadastrar informações no site?
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Somente autoridades.</strong> Familiares e amigos podem fornecer as informações necessárias às autoridades, mas somente elas tem permissão para fazer registros.
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> 
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            O que fazer se encontrar uma pessoa desaparecida?
                        </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Os usuários devem entrar em contato imediatamente com as autoridades policiais e informar sobre a situação.
                        </div>
                        </div>
                    </div>
                </div>

            </div><br><br><br><br><br><br><br><br>
@endsection