<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public function clientdata()
	{
        return  $this->belongsTo(Client::class, 'client', 'id');
        
    }
}
