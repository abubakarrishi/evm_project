<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $table = 'votes';
    protected $fillable = ['voter_id', 'candidate_id'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

 // app/Models/Vote.php

public function voter()
{
    return $this->belongsTo(User::class, 'voter_id');
}

}
