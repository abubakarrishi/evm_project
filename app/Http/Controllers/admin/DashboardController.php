<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $candidates = Candidate::all();
        return view('admin.dashboard', compact('candidates'));
    }
}
