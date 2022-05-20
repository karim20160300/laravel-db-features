<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function model(){
        return $this->morphTo(__FUNCTION__, 'model_name', 'model_id');
    }
}
