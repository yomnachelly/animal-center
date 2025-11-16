<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VetController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== 'vet') {
            abort(403, 'Accès réservé aux vétérinaires');
        }

        return view('vet.dashboard');
    }
}