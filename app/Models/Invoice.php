<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public function clientdata()
	{
        return  $this->belongsTo(Client::class, 'userid', 'id');
        
    }
    public function projectdata()
	{
        return  $this->belongsTo(Project::class, 'projectid', 'id');
        
    }
}
