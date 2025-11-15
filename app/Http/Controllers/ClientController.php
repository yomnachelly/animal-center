<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== 'client') {
            abort(403, 'Accès réservé aux clients');
        }

        return view('client.dashboard');
    }
}