<?php

namespace App\Functions;

class Randomizer {
    public static function generateID ($prefix){

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 8 ; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $prefix . '-' . $randomString;
    }
    
}
