<?php

namespace App\Models;

use App\Helpers\InfoGenerator;

class Player
{

    private $id;
    private $name;
    private $gender;
    private $atp;
    private $str;
    private $speed;
    private $reaction;
    private $luck;

    public function __construct($gender, $usedName = [])
    {
        $this->id = uniqid();
        $this->name = InfoGenerator::makeRandomName($gender, $usedName);
        $this->gender = $gender;
        $this->atp = InfoGenerator::randomNumber();
        $this->str = InfoGenerator::randomNumber(1, 20);
        $this->speed = InfoGenerator::randomNumber(1, 20);
        $this->reaction = InfoGenerator::randomNumber(1, 20);
        $this->luck = rand(-20, 40);
    }

    public function getFinalATP()
    {
        // Se determina la habilidad final del jugador segun su genero
        $finalATP = 0;
        if ($this->gender == 'M') {
            $finalATP = $this->atp + ($this->str + $this->speed) + $this->luck;
        } else {
            $finalATP = $this->atp + $this->reaction + $this->luck;
        }
        return $finalATP;
    }

    public function getPlayerDetails(): string
    {
        // Se obtienen los datos a mostrarse en el title de cada participante.
        if ($this->gender == 'M') {
            return " Habilidad: {$this->atp} \n Fuerza: {$this->str} \n Vel. Desplazamiento: {$this->speed} \n Suerte: {$this->luck} \n Total: {$this->getFinalATP()}";
        } else {
            return " Habilidad: {$this->atp} \n Reacción: {$this->reaction} \n Suerte: {$this->luck} \n Total: {$this->getFinalATP()}";
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function getatp()
    {
        return $this->atp;
    }

    public function setatp($atp)
    {
        $this->atp = $atp;

        return $this;
    }

    public function getStr()
    {
        return $this->str;
    }

    public function setStr($str)
    {
        $this->str = $str;

        return $this;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    public function getReaction()
    {
        return $this->reaction;
    }

    public function setReaction($reaction)
    {
        $this->reaction = $reaction;

        return $this;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;

        return $this;
    }
}
