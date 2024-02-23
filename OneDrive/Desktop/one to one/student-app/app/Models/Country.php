<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['continent', 'name', 'capital'];
    protected $hidden = ['id', 'student_id', 'created_at', 'updated_at'];
    use HasFactory;

    public function student() {
        return $this->belongsTo(Student::class);
    }
}