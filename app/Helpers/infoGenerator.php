<?php

namespace App\Helpers;

class InfoGenerator
{

    public static function makeRandomName($gender = 'F', $usedNamesArray = [])
    {
        $maleFirstNames = [
            'Juan', 'Carlos', 'Luis', 'Miguel', 'Andrés', 'Alejandro', 'Fernando', 'José', 'Roberto', 'Javier',
            'Héctor', 'Mario', 'Ricardo', 'Gabriel', 'Alberto', 'John', 'David', 'Michael', 'Daniel', 'Frank'
        ];
        $femaleFirstNames = [
            'María', 'Ana', 'Laura', 'Sofía', 'Isabella', 'Valentina', 'Gabriela', 'Verónica', 'Paula', 'Carolina',
            'Elena', 'Claudia', 'Camila', 'Daniela', 'Patricia', 'Jane', 'Emily', 'Olivia', 'Sophia', 'Mónica'
        ];

        $lastNames = [
            'Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Martínez', 'Gómez',
            'López', 'Rodríguez', 'Hernández', 'Pérez', 'García', 'Fernández', 'González', 'Sánchez', 'Ramírez', 'Torres',
            'Díaz', 'Cruz', 'Ruiz', 'Vásquez', 'Jiménez', 'Álvarez', 'Rojas', 'Moreno'
        ];

        // Seleccionar el array de nombres según el género
        $firstNames = ($gender === 'F') ? $femaleFirstNames : $maleFirstNames;

        // Mezclar y seleccionar un nombre y un apellido al azar
        shuffle($firstNames);
        shuffle($lastNames);

        $randomFirstName = array_pop($firstNames);
        $randomLastName = array_pop($lastNames);

        $fullName = "$randomFirstName $randomLastName";

        // Verificar si el array de nombres utilizados no está vacío
        if (!empty($usedNamesArray)) {
            $attempts = 0;

            // Mientras el nombre ya exista en el array de nombres utilizados y no se hayan hecho 3 intentos
            while (in_array($fullName, $usedNamesArray) && $attempts < 3) {
                // Incrementar el apellido agregando un número al final
                $attempts++;
                $randomLastName = $randomLastName . " " . array_pop($lastNames); //++$attempts;
                $fullName = "$randomFirstName $randomLastName";
            }
        }

        return $fullName;
    }

    public static function randomNumber($min = 0, $max = 100)
    {
        return rand($min, $max);
    }

    public static function isPowerOfTwo(int $value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        $intValue = (int)$value;
        if ($intValue <= 0) {
            return false;
        }

        // Verificar si es una potencia de 2
        return ($intValue & ($intValue - 1)) === 0;
    }
}
