<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprenantDashboardController extends Controller
{
    public function index()
    {
        return view('formateur.dashboard');
    }
    //
}
