<?php

namespace App\Models;

class Tournament
{
    private $type;
    private $cantPar;
    private $dateTournament;
    private $players = [];
    private $winner = [];

    public function __construct($type, $cantPar, $dateTournament = null, $players = [], $winner = [])
    {
        $this->type = $type;
        $this->cantPar = $cantPar;
        $this->dateTournament = $dateTournament ?: date('d/m/Y');
        $this->players = $players;
        $this->winner = $winner;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getCantPar()
    {
        return $this->cantPar;
    }

    public function setCantPar($cantPar)
    {
        $this->cantPar = $cantPar;
        return $this;
    }

    public function getDateTournament()
    {
        return $this->dateTournament;
    }

    public function setDateTournament($dateTournament)
    {
        $this->dateTournament = $dateTournament;
        return $this;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    public function toString()
    {
        $playersList = implode(', ', $this->players);

        return "Type: {$this->type}, Participants: {$this->cantPar}, Date: {$this->dateTournament}, Players: {$playersList}, Winner: {$this->winner}";
    }
}
