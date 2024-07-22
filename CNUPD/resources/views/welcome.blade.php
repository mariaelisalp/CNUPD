@extends('layouts.appPeople')

@section('title', 'Home')

@section('content')

<div class="container" style="max-width: 900px;">
    <br><br><h3 class="text-bg-light p-3">O que é CNUPD?</h3>
        <p class="shadow-none p-3 mb-5 bg-body-tertiary rounded" style="text-align: justify;">
        O CNUPD (Cadastro Nacional de Pessoas Desaparecidas) é uma iniciativa essencial que visa centralizar 
        e facilitar informações cruciais sobre pessoas desaparecidas e não identificadas em um esforço para 
        reunir famílias e oferecer suporte a investigações. Este site serve como uma plataforma abrangente 
        para registrar casos de desaparecimento e fornecer recursos importantes para a comunidade. <br><br>

        O intuito fundamental do CNUPD é servir como uma 
        ferramenta centralizada para auxiliar na resolução de casos de desaparecimento e na identificação de 
        pessoas não identificadas. Este site visa abordar diversas necessidades e desafios relacionados a essas 
        situações.
        </p>

        <h5 class="text-bg-warning p-3">A quem o CNUPD é destinado?</h5><br>

        <div class="row">
            <div class="col-md-4 mr-3">
                <div class="card" style="width: 14rem; border-width: 2px; border-color: black">
                    <img src="{{asset('icon-imgs/policial.png')}}" alt="" class="img-fluid">
                    <div class="card-header" style="background-color: #F8F8FF">
                        <div class="text-center">
                            <h5 class="card-title">Autoridades</h5>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card" style="width: 14rem; border-width: 2px; border-color: black">
                    <img src="{{asset('icon-imgs/pessoas-juntas.png')}}" alt="" class="img-fluid">
                    <div class="card-header" style="background-color: #F8F8FF">
                        <div class="text-center">
                            <h5 class="card-title"> Público </h5>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card" style="width: 14rem; border-width: 2px; border-color: black">
                    <img src="{{asset('icon-imgs/utilizador.png')}}" alt="" class="img-fluid">
                    <div class="card-header" style="background-color: #F8F8FF">
                        <div class="text-center">
                            <h5 class="card-title">Demais autorizados </h5>
                        </div>
                    </div>
                </div>
            </div>

        </div><br><br>

        <div class="text-center">
                
            <img src="{{asset('logo.png')}}" alt="" style="height: 100px; width: auto;">
                
        </div>

    
</div><br><br><br>
@include('parciais.footer')
@endsection