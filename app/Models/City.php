<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    /*-- Relations --*/


    public function client()
    {
        return $this->hasMany(Client::class);
    }
}
