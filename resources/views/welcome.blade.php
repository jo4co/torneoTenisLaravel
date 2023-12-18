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
        <div class="col-8 mt-4">
            <form action="{{ route('tournament.make') }}" method="GET" class="d-inline">
                <table class="table table-borderless text-white">
                    <tr class="text-secondary">
                        <th>Tipo Torneo</th>
                        <th>Participantes</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="gen" class="float-left form-control" required>
                                <option value="">Selecciona</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="cant" min="2" max="100" value="2" step="2"
                                class="float-right form-control" required>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">Avanzar</button>
            </form>
        </div>
    </div>


@endsection
