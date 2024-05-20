<?php

// namespace App\Http\Controllers;

// use App\Models\Vote;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class VoteController extends Controller
// {
//     public function store(Request $request, $candidateId)
//     {
//         $voterId = Auth::id();

//         // Check if the user has already voted
//         if (Vote::where('voter_id', $voterId)->exists()) {
//             return redirect()->back()->with('error', 'You have already voted.');
//         }

//         // Create a new vote
//         Vote::create([
//             'candidate_id' => $candidateId,
//             'voter_id' => $voterId,
//         ]);

//         return redirect()->back()->with('success', 'Your vote has been recorded.');
//     }
// }
