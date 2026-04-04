<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function teste(int $p1, int $p2) {
        //echo "A soma de $p1 + $p2 é: " . ($p1 + $p2);
        //return view('site.teste', ['x1' => $p1, 'y2' => $p2]); //Array associativo.
        return view('site.teste', compact('p1', 'p2')); //Compact
    }
}
