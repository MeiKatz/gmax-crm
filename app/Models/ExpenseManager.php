<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseManager extends Model
{
    use HasFactory;

    public function projectdata()
	{
        return  $this->belongsTo(Project::class, 'prid', 'id');
        
    }

}
