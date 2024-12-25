<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    protected $fillable =['name'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
