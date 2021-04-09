<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function user(){

        return $this->belongsTo(User::class,'teller_id');
    }

    public function project(){

        return $this->belongsTo(Project::class);
    }
}
