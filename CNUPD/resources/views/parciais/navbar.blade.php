<html>
    <head>
        <!-- Seção de cabeçalho, estilos, etc. -->

    </head>
    <body>
        <nav class="navbar navbar-expand-lg " style="background-color: #29B437;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">CNUPD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ '/' }}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ '/' }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Painéis
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ '/pessoas/desaparecidos' }}">Desaparecidos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ '/pessoas/nao_identificados' }}">Não Identificados</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ '/pessoas/cadastrar' }}">Fazer um registro</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Serviços
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ '/serviços/registro' }}">Registro de pessoas</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ '/contatos' }}">Contatos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ '/faq' }}">Dúvidas</a>
                        </li>

                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/dashboard') }}">Perfil</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Conteúdo da página -->
    </body>
</html>
