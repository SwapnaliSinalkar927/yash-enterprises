<?php

if (!function_exists('camel_case_to_string')) {
    function camel_case_to_string($str)
    {
        $string = ucwords(str_replace('_', ' ', Str::snake($str)));
        return $string;
    }
}

if (!function_exists('getGpsCoordinate')) {
    function getGpsCoordinate($coordinate, $hemisphere){
        $parts = explode('/', $coordinate);

        if (count($parts) === 2) {
            $decimalCoordinate = $parts[0] / $parts[1];
            return ($hemisphere === 'S' || $hemisphere === 'W') ? -$decimalCoordinate : $decimalCoordinate;
        }

        return null;
    }
}

if (!function_exists('convertHindiToEnglish')) {
    function convertHindiToEnglishNumber($hindiNumber)
    {
        $hindiDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        // Replace each Hindi digit with its English counterpart
        return str_replace($hindiDigits, $englishDigits, $hindiNumber);
    }
}
