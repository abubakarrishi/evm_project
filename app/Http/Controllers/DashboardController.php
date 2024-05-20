<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $candidates = Candidate::all(); 
        return view('dashboard', compact('candidates'));
    }
}
