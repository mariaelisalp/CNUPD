@extends('layouts.appPeople')

@section('title', 'Histórico')

@section('content')


    <div class="container">

            <br><br><h3 class="text-bg-primary p-3">
                Histórico de atividade
            </h3><br>

        <hr style="margin-left: auto; margin-right: auto; height: 1px; color: #000; background-color: #000; width: 100%;">
            <div class="row">
                <div class="col-md-2">
                    <div>
                        <tr>
                            Filtros
                        </tr><br><br>

                        @php
                        
                            $selectedFilters = old('filters', []);
                            $selectedPeriod = old('period', '');
                        @endphp

                        <form action="{{route('admin.index_logs')}}" method="GET">
                            <div class="btn-group-vertical" role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck1" value="AUTHORIZE" {{ in_array('AUTHORIZE', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck1">Autorização</label><br>

                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck2" value="DISABLE" {{ in_array('DISABLE', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck2">Desabilitação</label><br>

                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck3" value="ENABLE" {{ in_array('ENABLE', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck3">Habilitação</label><br>

                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck4" value="CREATE" {{ in_array('CREATE', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck4">Registro</label><br>

                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck5" value="READ" {{ in_array('READ', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck5">Leitura</label><br>

                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck6" value="UPDATE" {{ in_array('UPDATE', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck6">Edição</label><br>

                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck7" value="DELETE" {{ in_array('DELETE', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck7">Exclusão</label><br>

                                <input type="checkbox" class="btn-check" name="filters[]" id="btncheck8" value="LOGIN" {{ in_array('LOGIN', $selectedFilters) ? 'checked' : '' }} autocomplete="off">
                                <label class="btn btn-outline-primary mb-3" for="btncheck8">Login</label><br>

                                <select name="period" class="form-select appearance-none border border-primary rounded-md py-2 px-3 bg-white text-primary focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Período</option>
                                    <option value="7" {{ $selectedPeriod == '7' ? 'selected' : '' }}>Últimos 7 dias</option>
                                    <option value="15" {{ $selectedPeriod == '15' ? 'selected' : '' }}>Últimos 15 dias</option>
                                    <option value="30" {{ $selectedPeriod == '30' ? 'selected' : '' }}>Último mês</option>
                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary btn-sm mt-3">Aplicar</button> 

                        </form>
                        

                    </div>
                    
                </div>

                <div class="col-md-10">
                    <div class="container">
                        @if($logs->isEmpty())
                            <div class="container">
                            <p>Nenhum resultado encontrado.</p>
                            </div>
                        @else
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Ação</th>
                                <th scope="col">Data</th>
                                <th scope="col">Descrição</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($logs as $log)
                                <tr>
                                    <td>{{$log->action}}</td>
                                    <td>{{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:m:s')}}</td>
                                    <td><span style="color: blue">{{$logs_details[$log->id]['username']}}</span> {{$log->description}} <span style="color: blue">{{$logs_details[$log->id]['target_user']}}</span>
                                    <span style="color: blue">{{$log->people_id}}</span>
                                </td>

                                </tr> 
                            
                            @endforeach
                        
                                </tr>
                            </tbody>
                            </table><br>

                            <div class="pagination">
                                {{ $logs->onEachSide(0)->links() }}
                            </div><br>
                        @endif

                    </div>
                </div>
            </div>
        <br><br>
        <div class="container">
            <a href="{{'/dashboard'}}">
                <button class="btn btn-warning btn-lg">Voltar</button>
            </a><br><br>
        </div>
    </div>
@include('parciais.footer')
@endsection
