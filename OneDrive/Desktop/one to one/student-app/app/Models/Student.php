<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'age', 'address'];
    protected $hidden = ['created_at', 'updated_at'];
    use HasFactory;

    public function academic() {
        return $this->hasOne(Academic::class);
    }

    public function country() {
        return $this->hasOne(Country::class);
    }
}