<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
     {
         $candidates = Candidate::all();
     
         return view('candidates.index', compact('candidates'));
     }
     
     
            
        public function vote($id)
        {
            $user = Auth::user();
            // Check if the user has already voted
            if (Vote::where('voter_id', $user->id)->exists()) {
                return redirect()->route('account.dashboard')->with('error', 'You have already voted.');
            }
            // Record the vote
            Vote::create([
                'voter_id' => $user->id, // Assign the ID of the user
                'candidate_id' => $id,
            ]);
        
            return redirect()->route('account.dashboard')->with('success', 'Your vote has been recorded.');
        }
        
    
        public function adminIndex()
        {
            $candidates = Candidate::with('votes')->get();
            return view('admin.candidates.index', compact('candidates'));
        }
        
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            'party_affiliation' => 'required|string|max:255',
            'ballot_measure_position' => 'nullable|string|max:500', // Adjust validation rules as needed for the ballot measure position
        ]);
    
        // Handle file upload if a photo is provided
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName); // Save the uploaded image to the 'uploads' directory
            $validatedData['photo'] = 'uploads/' . $imageName; // Store the image path in the database
        }
    
        // Create a new candidate record
        Candidate::create($validatedData);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Candidate created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        return view('candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'party_affiliation' => 'required',
        'photo' => 'nullable|image',
    ]);

    $candidate = Candidate::find($id);
    $candidate->name = $request->name;
    $candidate->party_affiliation = $request->party_affiliation;

    // Handle file upload if a new photo is provided
    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName); // Save the uploaded image to the 'uploads' directory
        $candidate->photo = 'uploads/' . $imageName; // Store the new image path in the database
    }

    $candidate->save();

    return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Candidate::destroy($id);
        return redirect()->route('admin.dashboard')->with('success', 'Candidate deleted successfully.');
    }
}
