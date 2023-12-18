<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentRequest;
use App\Models\Player;
use App\Helpers\InfoGenerator;

class TournamentController extends Controller
{

    public function home()
    {
        $title = 'Torneo Tenis 2023';
        $data['titulo'] = $title;

        return redirect('/')->with($data);
    }

    public function makeTournament(TournamentRequest $request)
    {
        $reqData = $request->validated();
        $gen = $reqData['gen'];
        $cant = $reqData['cant'];

        if (!InfoGenerator::isPowerOfTwo($cant)) {
            return redirect('/')->withErrors("Por favor, elige un número que sea una potencia de 2.
            Esto significa que el número debe ser una cantidad que pueda obtenerse multiplicando 2 
            por sí misma varias veces. Lamentablemente, {$cant} no cumple con este requisito.");
        }

        $title = 'Torneo Tennis 2023';
        $data = [];
        $players = [];
        $info = $gen . " -" . $cant;

        if (!is_null($gen) && !is_null($cant)) {

            $usedNames = [];

            // Se crean todos los jugadores
            for ($i = 0; $i < $cant; $i++) {
                $player = new Player($gen, $usedNames);
                $players[] = $player;

                // Se agrega el nombre del nuevo jugador al array para evitar que se repita
                $usedNames[] = $player->getName();
            }
            $data['players'] =  $players;
        }

        $data['titulo'] = $title;
        $data['info'] = $info;

        return view('/Tournament', $data);
    }

    private function makeTournamentTree($players)
    {
        $ronda = 1;
        $data = [];

        while (count($players) > 1) {
            $ganadores = [];

            for ($i = 0; $i < count($players); $i += 2) {
                $jugador1 = $players[$i];
                $jugador2 = $players[$i + 1];

                // Se Simula el proceso de determinar un ganador 
                $ganador = $this->getWinner($jugador1, $jugador2);

                $data[] = [
                    'ronda' => $ronda,
                    'player1' => [
                        'name' => $jugador1->getName(),
                        'info' => $jugador1->getPlayerDetails()
                    ],
                    'player2' => [
                        'name' => $jugador2->getName(),
                        'info' => $jugador2->getPlayerDetails()
                    ],
                    'winner' => [
                        'name' => $ganador->getName(),
                        'info' => $ganador->getPlayerDetails()
                    ],
                ];

                $ganadores[] = $ganador;
            }

            $players = $ganadores;
            $ronda++;
        }

        return $data;
    }

    public function gridMaker($players)
    {
        $data = $this->makeTournamentTree($players);
        //dd($data);
        $groupedData = [];

        // Agrupar por ronda
        foreach ($data as $round) {
            $ronda = $round['ronda'];
            $groupedData[$ronda][] = $round;
        }

        $html = '';

        // Obtener la ronda máxima
        $maxRonda = max(array_keys($groupedData));

        foreach ($groupedData as $ronda => $rounds) {
            $html .= '<center><h1>Ronda ' . $ronda;

            if ($ronda == $maxRonda) {
                $html .= ' - Final';
            }

            $html .= '</h1></center>';
            $html .= '<table class="table table-bordered">';
            $html .= '<thead>';
            $html .= '<tr style="background-color: #f2f2f2;text-align: center;">';
            $html .= '<th>Jugador 1</th>';
            $html .= '<th>Jugador 2</th>';
            $html .= '<th>Ganador</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            foreach ($rounds as $round) {
                $html .= '<tr>';
                $html .= '<td title="' . $round['player1']['info']  . '"style="text-align: center;">' . $round['player1']['name'] . '</td>';
                $html .= '<td title="' . $round['player2']['info']  . '"style="text-align: center;">' . $round['player2']['name'] . '</td>';
                $html .= '<td title="' . $round['winner']['info']  . '" style="background-color: #aaffaa; text-align: center;"><b>' . $round['winner']['name'] . '</b></td>';
                $html .= '</tr>';
            }

            $html .= '</tbody>';
            $html .= '</table>';
        }
        return $html;
    }


    private function getWinner(Player $player1, Player $player2)
    {
        $atpPlayer1 = $player1->getFinalATP();
        $atpPlayer2 = $player2->getFinalATP();


        if ($atpPlayer1 > $atpPlayer2) {
            return $player1; // Gana jugar 1
        } elseif ($atpPlayer2 > $atpPlayer1) {
            return $player2; // Gana jugar 2
        } else {
            // Empate, determina al ganador según la suerte
            $luckPlayer1 = $player1->getLuck();
            $luckPlayer2 = $player2->getLuck();

            // Si los valores de suerte son iguales, elige aleatoriamente
            if ($luckPlayer1 == $luckPlayer2) {
                $randomWinner = rand(0, 1);
                return $randomWinner == 0 ? $player1 : $player2;
            }

            // Devuelve al jugador con mayor suerte
            return $luckPlayer1 > $luckPlayer2 ? $player1 : $player2;
        }
    }
}
