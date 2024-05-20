<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'photo','ballot_measure_position', 'party_affiliation',];
    // app/Models/Candidate.php

// app/Models/Candidate.php

public function votes()
{
    return $this->hasMany(Vote::class, 'candidate_id');
}


}
