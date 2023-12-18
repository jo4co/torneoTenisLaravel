@inject('tournamentController', 'App\Http\Controllers\TournamentController')

@extends('layouts.master')

@section('title', $titulo)

@section('content')
    <div class="col-10">
        <h1>{{ 'Bienvenido al torneo de tenis 2023' }}</h1>
        <a href=" /">
            <button class="btn btn-primary">Nuevo Torneo</button>
        </a>
    </div>

    <br>
    <div class="row">
        <div class="col-10 mt-6">
            <form action="{{ route('tournament.make') }}" method="GET" class="d-inline">
                <table class="table table-borderless text-white">
                    <tr class="text-secondary">
                        <th>Tipo Torneo</th>
                        <th>Participantes</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="gen" class="float-left form-control" title="Selecciona el genero del torneo"
                                @if (request()->has('gen')) disabled @endif required>
                                <option value="">Selecciona</option>
                                <option value="F" @if (request('gen') == 'F') selected @endif>Femenino</option>
                                <option value="M" @if (request('gen') == 'M') selected @endif>Masculino</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="cant" min="2" max="100"
                                value="{{ request()->has('cant') ? request('cant') : '2' }}" step="2"
                                class="float-right form-control" pattern="\d+" title="Solo se permiten potencias de 2"
                                @if (request()->has('cant')) disabled @endif required>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">Avanzar</button>
            </form>
        </div>
    </div>


    @if (request()->has('gen') && request()->has('cant'))

        @if (isset($players) && is_array($players) && count($players) > 0)
            {!! $tournamentController->gridMaker($players) !!}
        @else
            <p>No hay jugadores disponibles.</p>
        @endif
    @else
        <p>Error en los parámetros. Por favor, asegúrate de proporcionar valores para 'gen' y 'cant'.</p>
    @endif

@endsection
